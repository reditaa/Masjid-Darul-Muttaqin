<?php

namespace App\Http\Controllers;

use App\Models\JadwalBilal;
use App\Models\JadwalImamMuazin;
use App\Models\JadwalPiketKebersihan;
use App\Models\Kegiatan;
use App\Models\Pengurus;
use App\Models\Presensi;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    private array $jenisMap = [
        'imam_muazin' => JadwalImamMuazin::class,
        'bilal'       => JadwalBilal::class,
        'piket'       => JadwalPiketKebersihan::class,
        'kegiatan'    => Kegiatan::class,
    ];

    public function index()
    {
        $presensi = Presensi::with(['presentable', 'pengurus'])
            ->orderBy('tanggal', 'desc')
            ->paginate(15);

        return view('presensi.index', compact('presensi'));
    }

    public function create()
    {
        $pengurus = Pengurus::aktif()->orderBy('nama')->get();

        $jadwalImamMuazin = JadwalImamMuazin::all();
        $jadwalBilal = JadwalBilal::all();
        $jadwalPiket = JadwalPiketKebersihan::all();
        $kegiatan = Kegiatan::orderBy('tanggal_mulai', 'desc')->get();

        return view('presensi.create', compact(
            'pengurus', 'jadwalImamMuazin', 'jadwalBilal', 'jadwalPiket', 'kegiatan'
        ));
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        $modelClass = $this->jenisMap[$validated['jenis']];

        $validated['foto'] = $request->file('foto')->store('presensi', 'public');
        $validated['presentable_type'] = $modelClass;
        $validated['presentable_id'] = $validated['presentable_id'];
        $validated['dicatat_oleh'] = auth()->id();

        unset($validated['jenis']);

        Presensi::create($validated);

        return redirect()
            ->route('presensi.index')
            ->with('success', 'Presensi berhasil dicatat.');
    }

    public function destroy(Presensi $presensi)
    {
        if ($presensi->foto) {
            \Storage::disk('public')->delete($presensi->foto);
        }

        $presensi->delete();

        return redirect()
            ->route('presensi.index')
            ->with('success', 'Presensi berhasil dihapus.');
    }

    private function validateData(Request $request): array
    {
        $validated = $request->validate([
            'jenis'           => 'required|in:imam_muazin,bilal,piket,kegiatan',
            'presentable_id'  => 'required|integer',
            'pengurus_id'     => 'required|exists:pengurus,id',
            'tanggal'         => 'required|date',
            'status'          => 'required|in:hadir,tidak_hadir,izin,sakit,diganti',
            'waktu_presensi'  => 'nullable',
            'foto'            => 'required|image|max:2048',
            'keterangan'      => 'nullable|string',
        ]);

        $modelClass = $this->jenisMap[$validated['jenis']];

        $request->validate([
            'presentable_id' => 'exists:' . (new $modelClass)->getTable() . ',id',
        ]);

        return $validated;
    }
}