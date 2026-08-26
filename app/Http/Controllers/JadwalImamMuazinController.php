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
        $jadwal = JadwalImamMuazin::with(['imam', 'muazin'])
            ->get()
            ->sortBy(function ($item) {
                $hariIndex = array_search($item->hari, $this->hariUrutan);
                $waktuIndex = array_search($item->waktu_sholat, $this->waktuUrutan);
                return ($hariIndex * 10) + $waktuIndex;
            })
            ->groupBy('hari');

        $hariUrutan = $this->hariUrutan;

        return view('jadwal-imam-muazin.index', compact('jadwal', 'hariUrutan'));
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

        $this->syncAnggota($jadwal, $validated['imam_ids'], 'imam');
        $this->syncAnggota($jadwal, $validated['muazin_ids'], 'muazin');

        return redirect()
            ->route('jadwal-imam-muazin.index')
            ->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit(JadwalImamMuazin $jadwal_imam_muazin)
    {
        $pengurus = Pengurus::aktif()->orderBy('nama')->get();
        $jadwal_imam_muazin->load(['imam', 'muazin']);

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

        $this->syncAnggota($jadwal_imam_muazin, $validated['imam_ids'], 'imam');
        $this->syncAnggota($jadwal_imam_muazin, $validated['muazin_ids'], 'muazin');

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

    /**
     * Sync anggota untuk peran tertentu (imam / muazin) tanpa menghapus peran lainnya.
     */
    private function syncAnggota(JadwalImamMuazin $jadwal, array $ids, string $peran): void
    {
        // Hapus dulu baris lama untuk peran ini saja
        $jadwal->pengurus()
            ->wherePivot('peran', $peran)
            ->newPivotStatement()
            ->where('jadwal_imam_muazin_id', $jadwal->id)
            ->where('peran', $peran)
            ->delete();

        $data = [];
        foreach ($ids as $index => $pengurusId) {
            if ($pengurusId) {
                $data[] = [
                    'jadwal_imam_muazin_id' => $jadwal->id,
                    'pengurus_id' => $pengurusId,
                    'urutan' => $index + 1,
                    'peran' => $peran,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        if (!empty($data)) {
            \DB::table('jadwal_imam_muazin_anggotas')->insert($data);
        }
    }

      private function validateData(Request $request, ?int $ignoreId = null): array
    {
        $validated = $request->validate([
            'hari'          => 'required|in:senin,selasa,rabu,kamis,jumat,sabtu,minggu',
            'waktu_sholat'  => 'required|in:subuh,dzuhur,ashar,maghrib,isya',
            'imam_ids'      => 'required|array|min:1|max:3',
            'imam_ids.*'    => 'nullable|exists:pengurus,id',
            'muazin_ids'    => 'required|array|min:1|max:3',
            'muazin_ids.*'  => 'nullable|exists:pengurus,id',
            'keterangan'    => 'nullable|string',
        ]);

        // Cegah orang yang sama dipilih dua kali di kolom Imam
        $imamTerisi = array_filter($validated['imam_ids']);
        if (count($imamTerisi) !== count(array_unique($imamTerisi))) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'imam_ids' => 'Tidak boleh memilih orang yang sama lebih dari sekali sebagai Imam.',
            ]);
        }

        // Cegah orang yang sama dipilih dua kali di kolom Muazin
        $muazinTerisi = array_filter($validated['muazin_ids']);
        if (count($muazinTerisi) !== count(array_unique($muazinTerisi))) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'muazin_ids' => 'Tidak boleh memilih orang yang sama lebih dari sekali sebagai Muazin.',
            ]);
        }

        return $validated;
    }
}