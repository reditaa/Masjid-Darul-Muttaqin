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
            'koordinator',
            'anggota1'
        ])->latest()->paginate(5);

        return view('jadwal-piket.index', compact('jadwalPiket'));
    }

    public function create()
    {
        $pengurus = Pengurus::all();

        return view('jadwal-piket.create', compact('pengurus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal'=>'required',
            'koordinator_id'=>'required',
            'anggota1_id'=>'required',
            'keterangan'=>'nullable'
        ]);

        JadwalPiket::create($request->all());

        return redirect()->route('jadwal-piket.index')
            ->with('success','Jadwal berhasil ditambahkan.');
    }

    public function edit(JadwalPiket $jadwalPiket)
    {
        $pengurus = Pengurus::all();

        return view('jadwal-piket.edit', compact(
            'jadwalPiket',
            'pengurus'
        ));
    }

    public function update(Request $request, JadwalPiket $jadwalPiket)
    {
        $request->validate([
            'tanggal'=>'required',
            'koordinator_id'=>'required',
            'anggota1_id'=>'required',
            'keterangan'=>'nullable'
        ]);

        $jadwalPiket->update($request->all());

        return redirect()->route('jadwal-piket.index')
            ->with('success','Jadwal berhasil diubah.');
    }

    public function destroy(JadwalPiket $jadwalPiket)
    {
        $jadwalPiket->delete();

        return redirect()->route('jadwal-piket.index')
            ->with('success','Jadwal berhasil dihapus.');
    }
}