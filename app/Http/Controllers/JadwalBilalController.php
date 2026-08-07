<?php

namespace App\Http\Controllers;

use App\Models\JadwalBilal;
use App\Models\Pengurus;
use Illuminate\Http\Request;

class JadwalBilalController extends Controller
{
    private array $pasaranUrutan = ['legi', 'pahing', 'pon', 'wage', 'kliwon'];

    public function index()
    {
        $jadwal = JadwalBilal::with('anggota')
            ->get()
            ->sortBy(fn ($item) => array_search($item->pasaran, $this->pasaranUrutan));

        return view('jadwal-bilal.index', compact('jadwal'));
    }

    public function create()
    {
        $pengurus = Pengurus::aktif()->orderBy('nama')->get();

        return view('jadwal-bilal.create', compact('pengurus'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        $jadwal = JadwalBilal::create(['pasaran' => $validated['pasaran']]);
        $jadwal->anggota()->sync($validated['anggota_ids']);

        return redirect()
            ->route('jadwal-bilal.index')
            ->with('success', 'Jadwal bilal berhasil ditambahkan.');
    }

    public function edit(JadwalBilal $jadwal_bilal)
    {
        $pengurus = Pengurus::aktif()->orderBy('nama')->get();
        $jadwal_bilal->load('anggota');

        return view('jadwal-bilal.edit', [
            'jadwal' => $jadwal_bilal,
            'pengurus' => $pengurus,
        ]);
    }

    public function update(Request $request, JadwalBilal $jadwal_bilal)
    {
        $validated = $this->validateData($request, $jadwal_bilal->id);

        $jadwal_bilal->update(['pasaran' => $validated['pasaran']]);
        $jadwal_bilal->anggota()->sync($validated['anggota_ids']);

        return redirect()
            ->route('jadwal-bilal.index')
            ->with('success', 'Jadwal bilal berhasil diperbarui.');
    }

    public function destroy(JadwalBilal $jadwal_bilal)
    {
        $jadwal_bilal->delete();

        return redirect()
            ->route('jadwal-bilal.index')
            ->with('success', 'Jadwal bilal berhasil dihapus.');
    }

    private function validateData(Request $request, ?int $ignoreId = null): array
    {
        $rule = 'required|in:legi,pahing,pon,wage,kliwon';

        if ($ignoreId) {
            $rule .= '|unique:jadwal_bilals,pasaran,' . $ignoreId;
        } else {
            $rule .= '|unique:jadwal_bilals,pasaran';
        }

        return $request->validate([
            'pasaran'        => $rule,
            'anggota_ids'    => 'required|array|min:1',
            'anggota_ids.*'  => 'exists:pengurus,id',
        ]);
    }
}