<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPengumuman = Pengumuman::count();

        return view('dashboard', compact('totalPengumuman'));
    }
}