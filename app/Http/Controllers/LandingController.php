<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use App\Models\JadwalImam;
use App\Models\JadwalJumat;
use App\Models\JadwalAdzan;
use App\Models\JadwalPiket;

class LandingController extends Controller
{

    public function index()
    {

        // ==========================
        // PENGUMUMAN TERBARU
        // ==========================

        $pengumuman = Pengumuman::where('status','Aktif')
            ->latest()
            ->take(3)
            ->get();



        // ==========================
        // JADWAL IMAM
        // DZUHUR + ASHAR
        // ==========================

        $jadwalImam = JadwalImam::with([

            'dzuhurImam1',
            'dzuhurImam2',
            'dzuhurImam3',

            'asharImam1',
            'asharImam2',
            'asharImam3',

        ])
        ->latest()
        ->take(5)
        ->get();



        // ==========================
        // JADWAL JUMAT
        // KHATIB + IMAM
        // ==========================

        $jadwalJumat = JadwalJumat::with([

            'khatib',
            'imam',

        ])
        ->latest()
        ->first();



        // ==========================
        // JADWAL ADZAN
        // ==========================

        $jadwalAdzan = JadwalAdzan::latest()
            ->take(5)
            ->get();



        // ==========================
        // JADWAL PIKET
        // ==========================

        $jadwalPiket = JadwalPiket::latest()
            ->take(5)
            ->get();



        return view('landing', compact(

            'pengumuman',

            'jadwalImam',

            'jadwalJumat',

            'jadwalAdzan',

            'jadwalPiket'

        ));

    }

}