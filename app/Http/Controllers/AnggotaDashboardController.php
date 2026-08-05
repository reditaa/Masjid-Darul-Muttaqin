<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class AnggotaDashboardController extends Controller
{
    /**
     * Tampilkan dashboard anggota yang sedang login
     */
    public function index(Request $request): View
    {
        $anggota = auth('anggota')->user();

        return view('anggota.dashboard', compact('anggota'));
    }
}