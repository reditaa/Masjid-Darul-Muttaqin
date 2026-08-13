<?php

namespace App\Http\Controllers;

use App\Models\JadwalImamMuazin;
use App\Models\Pengurus;
use Illuminate\Http\Request;

class JadwalImamMuazinController extends Controller
{
    private array $hariUrutan = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'];
    private array $waktuUrutan = ['subuh', 'dzuhur', 'ashar', 'maghrib', 'isya'];

    public function index()
    {
        $jadwal = JadwalImamMuazin::with('anggota')
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

        $jadwal = JadwalImamMuazin::create([
            'hari' => $validated['hari'],
            'waktu_sholat' => $validated['waktu_sholat'],
            'keterangan' => $validated['keterangan'] ?? null,
        ]);

        $this->syncAnggota($jadwal, $validated['imam_ids']);

        return redirect()
            ->route('jadwal-imam-muazin.index')
            ->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit(JadwalImamMuazin $jadwal_imam_muazin)
    {
        $pengurus = Pengurus::aktif()->orderBy('nama')->get();
        $jadwal_imam_muazin->load('anggota');

        return view('jadwal-imam-muazin.edit', [
            'jadwal' => $jadwal_imam_muazin,
            'pengurus' => $pengurus,
        ]);
    }

    public function update(Request $request, JadwalImamMuazin $jadwal_imam_muazin)
    {
        $validated = $this->validateData($request, $jadwal_imam_muazin->id);

        $jadwal_imam_muazin->update([
            'hari' => $validated['hari'],
            'waktu_sholat' => $validated['waktu_sholat'],
            'keterangan' => $validated['keterangan'] ?? null,
        ]);

        $this->syncAnggota($jadwal_imam_muazin, $validated['imam_ids']);

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

    private function syncAnggota(JadwalImamMuazin $jadwal, array $imamIds): void
    {
        $syncData = [];
        foreach ($imamIds as $index => $pengurusId) {
            if ($pengurusId) {
                $syncData[$pengurusId] = ['urutan' => $index + 1];
            }
        }
        $jadwal->anggota()->sync($syncData);
    }

    private function validateData(Request $request, ?int $ignoreId = null): array
    {
        $rule = 'required|in:senin,selasa,rabu,kamis,jumat,sabtu,minggu';
        $uniqueRule = $rule . '|unique:jadwal_imam_muazins,hari,NULL,id,waktu_sholat,' . $request->waktu_sholat;

        return $request->validate([
            'hari'          => 'required|in:senin,selasa,rabu,kamis,jumat,sabtu,minggu',
            'waktu_sholat'  => 'required|in:subuh,dzuhur,ashar,maghrib,isya',
            'imam_ids'      => 'required|array|min:1|max:3',
            'imam_ids.*'    => 'nullable|exists:pengurus,id',
            'keterangan'    => 'nullable|string',
        ]);
    }
}