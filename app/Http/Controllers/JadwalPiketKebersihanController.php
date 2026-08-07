<?php

namespace App\Http\Controllers;

use App\Models\JadwalPiketKebersihan;
use App\Models\Pengurus;
use Illuminate\Http\Request;

class JadwalPiketKebersihanController extends Controller
{
    private array $hariUrutan = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'];

    public function index()
    {
        $jadwal = JadwalPiketKebersihan::with('anggota')
            ->get()
            ->sortBy(fn ($item) => array_search($item->hari, $this->hariUrutan));

        return view('jadwal-piket-kebersihan.index', compact('jadwal'));
    }

    public function create()
    {
        $pengurus = Pengurus::aktif()->orderBy('nama')->get();

        return view('jadwal-piket-kebersihan.create', compact('pengurus'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        $jadwal = JadwalPiketKebersihan::create(['hari' => $validated['hari']]);
        $jadwal->anggota()->sync($validated['anggota_ids']);

        return redirect()
            ->route('jadwal-piket-kebersihan.index')
            ->with('success', 'Jadwal piket berhasil ditambahkan.');
    }

    public function edit(JadwalPiketKebersihan $jadwal_piket_kebersihan)
    {
        $pengurus = Pengurus::aktif()->orderBy('nama')->get();
        $jadwal_piket_kebersihan->load('anggota');

        return view('jadwal-piket-kebersihan.edit', [
            'jadwal' => $jadwal_piket_kebersihan,
            'pengurus' => $pengurus,
        ]);
    }

    public function update(Request $request, JadwalPiketKebersihan $jadwal_piket_kebersihan)
    {
        $validated = $this->validateData($request, $jadwal_piket_kebersihan->id);

        $jadwal_piket_kebersihan->update(['hari' => $validated['hari']]);
        $jadwal_piket_kebersihan->anggota()->sync($validated['anggota_ids']);

        return redirect()
            ->route('jadwal-piket-kebersihan.index')
            ->with('success', 'Jadwal piket berhasil diperbarui.');
    }

    public function destroy(JadwalPiketKebersihan $jadwal_piket_kebersihan)
    {
        $jadwal_piket_kebersihan->delete();

        return redirect()
            ->route('jadwal-piket-kebersihan.index')
            ->with('success', 'Jadwal piket berhasil dihapus.');
    }

    private function validateData(Request $request, ?int $ignoreId = null): array
    {
        $rule = 'required|in:senin,selasa,rabu,kamis,jumat,sabtu,minggu';

        if ($ignoreId) {
            $rule .= '|unique:jadwal_piket_kebersihans,hari,' . $ignoreId;
        } else {
            $rule .= '|unique:jadwal_piket_kebersihans,hari';
        }

        return $request->validate([
            'hari'           => $rule,
            'anggota_ids'    => 'required|array|min:1',
            'anggota_ids.*'  => 'exists:pengurus,id',
        ]);
    }
}