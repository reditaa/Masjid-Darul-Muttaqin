<?php

namespace App\Http\Controllers;

use App\Models\JadwalImamMuazin;
use App\Models\Pengurus;
use Illuminate\Http\Request;

class JadwalImamMuazinController extends Controller
{
    private array $hariUrutan = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'];
    private array $waktuUrutan = ['subuh', 'dzuhur', 'ashar', 'maghrib', 'isya', 'jumat'];

    public function index()
    {
        $jadwal = JadwalImamMuazin::with(['imam', 'muazin', 'khatib'])
            ->get()
            ->sortBy(function ($item) {
                $hariIndex = array_search($item->hari, $this->hariUrutan);
                $waktuIndex = array_search($item->waktu_sholat, $this->waktuUrutan);
                return ($hariIndex * 10) + $waktuIndex;
            });

        return view('jadwal-imam-muazin.index', compact('jadwal'));
    }

    public function create()
    {
        $pengurus = Pengurus::aktif()->orderBy('nama')->get();

        return view('jadwal-imam-muazin.create', compact('pengurus'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        JadwalImamMuazin::create($validated);

        return redirect()
            ->route('jadwal-imam-muazin.index')
            ->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit(JadwalImamMuazin $jadwal_imam_muazin)
    {
        $pengurus = Pengurus::aktif()->orderBy('nama')->get();

        return view('jadwal-imam-muazin.edit', [
            'jadwal' => $jadwal_imam_muazin,
            'pengurus' => $pengurus,
        ]);
    }

    public function update(Request $request, JadwalImamMuazin $jadwal_imam_muazin)
    {
        $validated = $this->validateData($request, $jadwal_imam_muazin->id);

        $jadwal_imam_muazin->update($validated);

        return redirect()
            ->route('jadwal-imam-muazin.index')
            ->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(JadwalImamMuazin $jadwal_imam_muazin)
    {
        $jadwal_imam_muazin->delete();

        return redirect()
            ->route('jadwal-imam-muazin.index')
            ->with('success', 'Jadwal berhasil dihapus.');
    }

    private function validateData(Request $request, ?int $ignoreId = null): array
    {
        $rules = [
            'hari'          => 'required|in:senin,selasa,rabu,kamis,jumat,sabtu,minggu',
            'waktu_sholat'  => 'required|in:subuh,dzuhur,ashar,maghrib,isya,jumat',
            'imam_id'       => 'required|exists:pengurus,id',
            'khatib_id'     => 'nullable|exists:pengurus,id',
            'muazin_id'     => 'nullable|exists:pengurus,id',
            'keterangan'    => 'nullable|string',
        ];

        return $request->validate($rules);
    }
}