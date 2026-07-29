<?php

namespace App\Http\Controllers;

use App\Models\JadwalImam;
use App\Models\Pengurus;
use Illuminate\Http\Request;

class JadwalImamController extends Controller
{
    public function index()
    {
        $jadwalImam = JadwalImam::with('imam')
            ->latest()
            ->paginate(10);

        return view('jadwal-imam.index', compact('jadwalImam'));
    }

    public function create()
    {
        $pengurus = Pengurus::with(['anggota.guru', 'anggota.siswa'])
            ->get();

        return view('jadwal-imam.create', compact('pengurus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'imam_id' => 'required|exists:pengurus,id',
            'keterangan' => 'nullable',
        ]);

        JadwalImam::create($request->all());

        return redirect()
            ->route('jadwal-imam.index')
            ->with('success', 'Jadwal imam berhasil ditambahkan.');
    }

    public function edit(JadwalImam $jadwalImam)
    {
        $pengurus = Pengurus::with(['anggota.guru', 'anggota.siswa'])
            ->get();

        return view('jadwal-imam.edit', compact(
            'jadwalImam',
            'pengurus'
        ));
    }

    public function update(Request $request, JadwalImam $jadwalImam)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'imam_id' => 'required|exists:pengurus,id',
            'keterangan' => 'nullable',
        ]);

        $jadwalImam->update($request->all());

        return redirect()
            ->route('jadwal-imam.index')
            ->with('success', 'Jadwal imam berhasil diubah.');
    }

    public function destroy(JadwalImam $jadwalImam)
    {
        $jadwalImam->delete();

        return redirect()
            ->route('jadwal-imam.index')
            ->with('success', 'Jadwal imam berhasil dihapus.');
    }
}