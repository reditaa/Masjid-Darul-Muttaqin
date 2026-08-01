<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use App\Models\Pengurus;
use App\Models\Anggota;
use App\Models\JadwalImam;
use App\Models\JadwalJumat;

class LandingController extends Controller
{
    public function index()
    {
        // Statistik
        $jumlahPengurus = Pengurus::count();
        $jumlahAnggota = Anggota::count();
        $jumlahPengumuman = Pengumuman::where('status', 'Aktif')->count();
        $jumlahJadwal = JadwalImam::count();

        // Pengumuman terbaru
        $pengumuman = Pengumuman::where('status', 'Aktif')
            ->latest()
            ->take(3)
            ->get();

        // Jadwal Imam
        $jadwalImam = JadwalImam::with([
            'dzuhurImam1.anggota',
            'dzuhurImam2.anggota',
            'dzuhurImam3.anggota',
            'asharImam1.anggota',
            'asharImam2.anggota',
            'asharImam3.anggota',
        ])
        ->latest()
        ->take(5)
        ->get();

        // Jadwal Jumat
        $jadwalJumat = JadwalJumat::with([
            'khatib.anggota',
            'imam.anggota',
        ])
        ->latest()
        ->first();

        return view('landing', compact(
            'pengumuman',
            'jadwalImam',
            'jadwalJumat',
            'jumlahPengurus',
            'jumlahAnggota',
            'jumlahPengumuman',
            'jumlahJadwal'
        ));
    }
}