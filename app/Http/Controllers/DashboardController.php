<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use App\Models\Pengumuman;
use App\Models\JadwalImam;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPengurus = Pengurus::count();
        $totalPengumuman = Pengumuman::count();

        // Hitung jumlah jadwal imam
        $totalImam = JadwalImam::count();

        // Modul lain sementara
        $totalMuazin = 0;
        $totalInventaris = 0;
        $totalPiket = 0;

        return view('dashboard', compact(
            'totalPengurus',
            'totalPengumuman',
            'totalImam',
            'totalMuazin',
            'totalInventaris',
            'totalPiket'
        ));
    }
}