<?php

namespace App\Http\Controllers;

use App\Models\JadwalJumat;
use App\Models\Pengurus;
use Illuminate\Http\Request;

class JadwalJumatController extends Controller
{
    public function index()
    {
        $jadwalJumat = JadwalJumat::with([
            'khatib',
            'imam'
        ])->latest()->get();

        return view('jadwal-jumat.index', compact('jadwalJumat'));
    }

    public function create()
    {
        $pengurus = Pengurus::with('anggota')
            ->where('status', 'Aktif')
            ->get();

        return view('jadwal-jumat.create', compact('pengurus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pasaran' => 'required|in:Pon,Kliwon,Pahing,Wage,Legi',
            'khatib_id' => 'required|exists:pengurus,id',
            'imam_id' => 'required|exists:pengurus,id',
        ]);

        JadwalJumat::create([
            'pasaran' => $request->pasaran,
            'khatib_id' => $request->khatib_id,
            'imam_id' => $request->imam_id,
        ]);

        return redirect()
            ->route('jadwal-imam.index')
            ->with('success', 'Jadwal Jumat berhasil ditambahkan.');
    }

    public function edit(JadwalJumat $jadwalJumat)
    {
        $pengurus = Pengurus::with('anggota')
            ->where('status', 'Aktif')
            ->get();

        return view('jadwal-jumat.edit', compact('jadwalJumat', 'pengurus'));
    }

    public function update(Request $request, JadwalJumat $jadwalJumat)
    {
        $request->validate([
            'pasaran' => 'required|in:Pon,Kliwon,Pahing,Wage,Legi',
            'khatib_id' => 'required|exists:pengurus,id',
            'imam_id' => 'required|exists:pengurus,id',
        ]);

        $jadwalJumat->update([
            'pasaran' => $request->pasaran,
            'khatib_id' => $request->khatib_id,
            'imam_id' => $request->imam_id,
        ]);

        return redirect()
            ->route('jadwal-imam.index')
            ->with('success', 'Jadwal Jumat berhasil diubah.');
    }

    public function destroy(JadwalJumat $jadwalJumat)
    {
        $jadwalJumat->delete();

        return redirect()
            ->route('jadwal-imam.index')
            ->with('success', 'Jadwal Jumat berhasil dihapus.');
    }
}