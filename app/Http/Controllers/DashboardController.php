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

        // Jumlah personel bertugas imam & bilal
        $totalImam = \Illuminate\Support\Facades\DB::table('jadwal_imam_muazin_anggotas')
            ->distinct()
            ->count('pengurus_id');

        $totalMuazin = \Illuminate\Support\Facades\DB::table('jadwal_bilal_anggotas')
            ->distinct()
            ->count('pengurus_id');

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