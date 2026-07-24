<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPengurus = Pengurus::count();

        $totalPengumuman = 0;
        $totalInventaris = 0;
        $totalPresensi = 0;

        return view('dashboard', compact(
            'totalPengurus',
            'totalPengumuman',
            'totalInventaris',
            'totalPresensi'
        ));
    }
}