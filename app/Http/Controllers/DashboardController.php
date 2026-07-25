<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use App\Models\Pengumuman;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPengurus = Pengurus::count();
        $totalPengumuman = Pengumuman::count();

        // Sementara masih 0 karena modul belum dibuat
        $totalImam = 0;
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