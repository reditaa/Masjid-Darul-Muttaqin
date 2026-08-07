<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Pengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KegiatanController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->query('tab', 'kalender');

        $kegiatan = $tab === 'riwayat'
            ? Kegiatan::riwayat()->orderBy('tanggal_mulai', 'desc')->paginate(10)
            : Kegiatan::akanDatang()->orderBy('tanggal_mulai')->paginate(10);

        return view('kegiatan.index', compact('kegiatan', 'tab'));
    }

    public function create()
    {
        $pengurus = Pengurus::aktif()->orderBy('nama')->get();

        return view('kegiatan.create', compact('pengurus'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        if ($request->hasFile('poster')) {
            $validated['poster'] = $request->file('poster')->store('kegiatan', 'public');
        }

        Kegiatan::create($validated);

        return redirect()
            ->route('kegiatan.index')
            ->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    public function show(Kegiatan $kegiatan)
    {
        $kegiatan->load('penanggungJawab', 'galeris');

        return view('kegiatan.show', compact('kegiatan'));
    }

    public function edit(Kegiatan $kegiatan)
    {
        $pengurus = Pengurus::aktif()->orderBy('nama')->get();

        return view('kegiatan.edit', compact('kegiatan', 'pengurus'));
    }

    public function update(Request $request, Kegiatan $kegiatan)
    {
        $validated = $this->validateData($request, $kegiatan->id);

        if ($request->hasFile('poster')) {
            if ($kegiatan->poster) {
                Storage::disk('public')->delete($kegiatan->poster);
            }
            $validated['poster'] = $request->file('poster')->store('kegiatan', 'public');
        }

        $kegiatan->update($validated);

        return redirect()
            ->route('kegiatan.index')
            ->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function destroy(Kegiatan $kegiatan)
    {
        if ($kegiatan->poster) {
            Storage::disk('public')->delete($kegiatan->poster);
        }

        $kegiatan->delete();

        return redirect()
            ->route('kegiatan.index')
            ->with('success', 'Kegiatan berhasil dihapus.');
    }

    private function validateData(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'judul'                => 'required|string|max:255',
            'deskripsi'            => 'nullable|string',
            'kategori'             => 'required|in:kajian,pengajian,phbi,santunan,bakti_sosial,lainnya',
            'tanggal_mulai'        => 'required|date',
            'tanggal_selesai'      => 'nullable|date|after_or_equal:tanggal_mulai',
            'waktu_mulai'          => 'nullable',
            'waktu_selesai'        => 'nullable',
            'lokasi'               => 'nullable|string|max:255',
            'penanggung_jawab_id'  => 'nullable|exists:pengurus,id',
            'status'               => 'required|in:akan_datang,berlangsung,selesai,dibatalkan',
            'poster'               => 'nullable|image|max:2048',
            'anggaran'             => 'nullable|numeric|min:0',
            'jumlah_peserta'       => 'nullable|integer|min:0',
            'laporan_hasil'        => 'nullable|string',
        ]);
    }
}