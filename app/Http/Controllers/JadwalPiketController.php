<?php

namespace App\Http\Controllers;

use App\Models\JadwalPiket;
use App\Models\Pengurus;
use Illuminate\Http\Request;

class JadwalPiketController extends Controller
{
    public function index()
    {
        $jadwalPiket = JadwalPiket::with([
            'koordinator.anggota.guru',
            'koordinator.anggota.siswa',
            'anggota1.anggota.guru',
            'anggota1.anggota.siswa',
        ])->latest()->paginate(10);

        return view('jadwal-piket.index', compact('jadwalPiket'));
    }

    public function create()
    {
        $pengurus = Pengurus::with([
            'anggota.guru',
            'anggota.siswa'
        ])->get();

        return view('jadwal-piket.create', compact('pengurus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'koordinator_id' => 'required|exists:pengurus,id',
            'anggota1_id' => 'required|exists:pengurus,id',
            'keterangan' => 'nullable'
        ]);

        JadwalPiket::create($request->all());

        return redirect()
            ->route('jadwal-piket.index')
            ->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit(JadwalPiket $jadwalPiket)
    {
        $pengurus = Pengurus::with([
            'anggota.guru',
            'anggota.siswa'
        ])->get();

        return view('jadwal-piket.edit', compact(
            'jadwalPiket',
            'pengurus'
        ));
    }

    public function update(Request $request, JadwalPiket $jadwalPiket)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'koordinator_id' => 'required|exists:pengurus,id',
            'anggota1_id' => 'required|exists:pengurus,id',
            'keterangan' => 'nullable'
        ]);

        $jadwalPiket->update($request->all());

        return redirect()
            ->route('jadwal-piket.index')
            ->with('success', 'Jadwal berhasil diubah.');
    }

    public function destroy(JadwalPiket $jadwalPiket)
    {
        $jadwalPiket->delete();

        return redirect()
            ->route('jadwal-piket.index')
            ->with('success', 'Jadwal berhasil dihapus.');
    }
}