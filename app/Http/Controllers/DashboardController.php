<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use App\Models\Pengumuman;
use App\Models\JadwalImamMuazin;
use App\Models\Inventaris;
use App\Models\JadwalPiketKebersihan;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPengurus = Pengurus::count();
        $totalPengumuman = Pengumuman::count();

        // Jumlah pengurus yang bertugas sebagai imam (tidak dobel hitung)
        $totalImam = JadwalImamMuazin::whereNotNull('imam_id')
            ->distinct('imam_id')
            ->count('imam_id');

        // Jumlah pengurus yang bertugas sebagai muazin (tidak dobel hitung)
        $totalMuazin = JadwalImamMuazin::whereNotNull('muazin_id')
            ->distinct('muazin_id')
            ->count('muazin_id');

        $totalInventaris = Inventaris::count();
        $totalPiket = JadwalPiketKebersihan::count();

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