<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    /**
     * Ambil kredensial login (email & password mentah) dari Guru/Siswa
     * yang dipilih, sesuai jenisnya.
     */
    protected function ambilKredensial(string $jenis, ?int $guruId, ?int $siswaId): array
    {
        if ($jenis === 'Guru') {
            $guru = Guru::findOrFail($guruId);

            return [
                'email' => $guru->email,
                'password' => $guru->nip, // otomatis di-hash oleh cast 'hashed' di model Anggota
            ];
        }

        $siswa = Siswa::findOrFail($siswaId);

        return [
            'email' => $siswa->email,
            'password' => $siswa->nis, // otomatis di-hash oleh cast 'hashed' di model Anggota
        ];
    }

    public function index()
    {
        $anggotas = Anggota::with(['guru', 'siswa'])
            ->latest()
            ->paginate(10);

        return view('anggota.index', compact('anggotas'));
    }

    public function create()
    {
        $gurus = Guru::all();
        $siswas = Siswa::all();

        return view('anggota.create', compact('gurus', 'siswas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required|in:Guru,Siswa',
        ]);

        if ($request->jenis == 'Guru') {

            $request->validate(['guru_id' => 'required']);

            $kredensial = $this->ambilKredensial('Guru', $request->guru_id, null);

            Anggota::create([
                'guru_id' => $request->guru_id,
                'siswa_id' => null,
                'jenis' => 'Guru',
                'status' => 'Aktif',
                'email' => $kredensial['email'],
                'password' => $kredensial['password'],
            ]);

        } else {

            $request->validate(['siswa_id' => 'required']);

            $kredensial = $this->ambilKredensial('Siswa', null, $request->siswa_id);

            Anggota::create([
                'guru_id' => null,
                'siswa_id' => $request->siswa_id,
                'jenis' => 'Siswa',
                'status' => 'Aktif',
                'email' => $kredensial['email'],
                'password' => $kredensial['password'],
            ]);

        }

        return redirect()->route('anggota.index')
            ->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function edit(Anggota $anggotum)
    {
        $gurus = Guru::all();
        $siswas = Siswa::all();

        return view('anggota.edit', [
            'anggota' => $anggotum,
            'gurus' => $gurus,
            'siswas' => $siswas,
        ]);
    }

    public function update(Request $request, Anggota $anggotum)
    {
        $request->validate([
            'jenis' => 'required|in:Guru,Siswa',
            'status' => 'required',
        ]);

        if ($request->jenis == 'Guru') {

            $request->validate(['guru_id' => 'required']);

            $kredensial = $this->ambilKredensial('Guru', $request->guru_id, null);

            $anggotum->update([
                'guru_id' => $request->guru_id,
                'siswa_id' => null,
                'jenis' => 'Guru',
                'status' => $request->status,
                'email' => $kredensial['email'],
                'password' => $kredensial['password'],
            ]);

        } else {

            $request->validate(['siswa_id' => 'required']);

            $kredensial = $this->ambilKredensial('Siswa', null, $request->siswa_id);

            $anggotum->update([
                'guru_id' => null,
                'siswa_id' => $request->siswa_id,
                'jenis' => 'Siswa',
                'status' => $request->status,
                'email' => $kredensial['email'],
                'password' => $kredensial['password'],
            ]);

        }

        return redirect()->route('anggota.index')
            ->with('success', 'Anggota berhasil diubah.');
    }

    public function destroy(Anggota $anggotum)
    {
        $anggotum->delete();

        return redirect()->route('anggota.index')
            ->with('success', 'Anggota berhasil dihapus.');
    }
}