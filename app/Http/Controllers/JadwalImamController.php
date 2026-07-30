<?php

namespace App\Http\Controllers;

use App\Models\JadwalImam;
use App\Models\Pengurus;
use Illuminate\Http\Request;

class JadwalImamController extends Controller
{

    public function index()
    {
        $jadwal = JadwalImam::with([
            'imam1.anggota.guru',
            'imam1.anggota.siswa',
            'imam2.anggota.guru',
            'imam2.anggota.siswa',
            'imam3.anggota.guru',
            'imam3.anggota.siswa',
        ])->get();

        return view('jadwal-imam.index', compact('jadwal'));
    }


    public function create()
    {
        $pengurus = Pengurus::with([
            'anggota.guru',
            'anggota.siswa'
        ])->get();


        return view('jadwal-imam.create', compact('pengurus'));
    }



    public function store(Request $request)
    {

        $request->validate([
            'hari' => 'required',
            'waktu_sholat' => 'required',
            'imam_1' => 'required',
            'imam_2' => 'required',
            'imam_3' => 'required',
        ]);


        JadwalImam::create([
            'hari' => $request->hari,
            'waktu_sholat' => $request->waktu_sholat,
            'imam_1' => $request->imam_1,
            'imam_2' => $request->imam_2,
            'imam_3' => $request->imam_3,
        ]);


        return redirect()
            ->route('jadwal-imam.index')
            ->with('success','Jadwal imam berhasil ditambahkan');

    }



    public function destroy(JadwalImam $jadwal_imam)
    {
        $jadwal_imam->delete();


        return redirect()
            ->route('jadwal-imam.index')
            ->with('success','Jadwal berhasil dihapus');
    }

}