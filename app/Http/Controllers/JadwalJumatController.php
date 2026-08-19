<?php

namespace App\Http\Controllers;

use App\Models\JadwalJumat;
use App\Models\Pengurus;
use Illuminate\Http\Request;

class JadwalJumatController extends Controller
{
    private array $pasaranUrutan = ['legi', 'pahing', 'pon', 'wage', 'kliwon'];

    public function index()
    {
        $jadwal = JadwalJumat::with(['khatib', 'imam'])
            ->get()
            ->sortBy(fn ($item) => array_search($item->pasaran, $this->pasaranUrutan));

        return view('jadwal-jumat.index', compact('jadwal'));
    }

    public function create()
    {
        $pengurus = Pengurus::aktif()->orderBy('nama')->get();

        return view('jadwal-jumat.create', compact('pengurus'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        $jadwal = JadwalJumat::create([
            'pasaran' => $validated['pasaran'],
            'keterangan' => $validated['keterangan'] ?? null,
        ]);

        $this->syncAnggota($jadwal, $validated['khatib_ids'], $validated['imam_ids']);

        return redirect()
            ->route('jadwal-jumat.index')
            ->with('success', 'Jadwal Jumat berhasil ditambahkan.');
    }

    public function edit(JadwalJumat $jadwal_jumat)
    {
        $pengurus = Pengurus::aktif()->orderBy('nama')->get();
        $jadwal_jumat->load(['khatib', 'imam']);

        return view('jadwal-jumat.edit', [
            'jadwal' => $jadwal_jumat,
            'pengurus' => $pengurus,
        ]);
    }

    public function update(Request $request, JadwalJumat $jadwal_jumat)
    {
        $validated = $this->validateData($request, $jadwal_jumat->id);

        $jadwal_jumat->update([
            'pasaran' => $validated['pasaran'],
            'keterangan' => $validated['keterangan'] ?? null,
        ]);

        $this->syncAnggota($jadwal_jumat, $validated['khatib_ids'], $validated['imam_ids']);

        return redirect()
            ->route('jadwal-jumat.index')
            ->with('success', 'Jadwal Jumat berhasil diperbarui.');
    }

    public function destroy(JadwalJumat $jadwal_jumat)
    {
        $jadwal_jumat->delete();

        return redirect()
            ->route('jadwal-jumat.index')
            ->with('success', 'Jadwal Jumat berhasil dihapus.');
    }

    private function syncAnggota(JadwalJumat $jadwal, array $khatibIds, array $imamIds): void
    {
        $jadwal->khatib()->detach();
        $jadwal->imam()->detach();

        foreach ($khatibIds as $index => $pengurusId) {
            if ($pengurusId) {
                $jadwal->khatib()->attach($pengurusId, ['peran' => 'khatib', 'urutan' => $index + 1]);
            }
        }

        foreach ($imamIds as $index => $pengurusId) {
            if ($pengurusId) {
                $jadwal->imam()->attach($pengurusId, ['peran' => 'imam', 'urutan' => $index + 1]);
            }
        }
    }

    private function validateData(Request $request, ?int $ignoreId = null): array
    {
        $rule = 'required|in:legi,pahing,pon,wage,kliwon';

        if ($ignoreId) {
            $rule .= '|unique:jadwal_jumats,pasaran,' . $ignoreId;
        } else {
            $rule .= '|unique:jadwal_jumats,pasaran';
        }

        return $request->validate([
            'pasaran'        => $rule,
            'khatib_ids'     => 'required|array|min:1|max:2',
            'khatib_ids.*'   => 'nullable|exists:pengurus,id',
            'imam_ids'       => 'required|array|min:1|max:2',
            'imam_ids.*'     => 'nullable|exists:pengurus,id',
            'keterangan'     => 'nullable|string',
        ]);
    }
}