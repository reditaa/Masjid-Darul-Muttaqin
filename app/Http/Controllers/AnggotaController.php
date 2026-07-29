<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
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
            $request->validate([
                'guru_id' => 'required'
            ]);

            Anggota::create([
                'guru_id' => $request->guru_id,
                'siswa_id' => null,
                'jenis' => 'Guru',
                'status' => 'Aktif',
            ]);
        } else {
            $request->validate([
                'siswa_id' => 'required'
            ]);

            Anggota::create([
                'guru_id' => null,
                'siswa_id' => $request->siswa_id,
                'jenis' => 'Siswa',
                'status' => 'Aktif',
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
            'status' => 'required'
        ]);

        if ($request->jenis == 'Guru') {

            $anggotum->update([
                'guru_id' => $request->guru_id,
                'siswa_id' => null,
                'jenis' => 'Guru',
                'status' => $request->status,
            ]);

        } else {

            $anggotum->update([
                'guru_id' => null,
                'siswa_id' => $request->siswa_id,
                'jenis' => 'Siswa',
                'status' => $request->status,
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