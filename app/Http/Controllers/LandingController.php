<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use App\Models\Pengumuman;
use App\Models\JadwalImamMuazin;
use App\Models\JadwalBilal;
use App\Models\JadwalPiketKebersihan;
use App\Models\Kegiatan;

class LandingController extends Controller
{
    public function index()
    {
        $jumlahPengurus = Pengurus::count();
        $jumlahPengumuman = Pengumuman::published()->count();
        $jumlahJadwal = JadwalImamMuazin::count();
        $jumlahKegiatan = Kegiatan::count();

        $pengumuman = Pengumuman::published()
            ->latest('tanggal_publish')
            ->take(3)
            ->get();

        $jadwalImamMuazin = JadwalImamMuazin::with(['imam', 'muazin', 'khatib'])
            ->orderByRaw("FIELD(hari, 'senin','selasa','rabu','kamis','jumat','sabtu','minggu')")
            ->orderByRaw("FIELD(waktu_sholat, 'subuh','dzuhur','ashar','maghrib','isya','jumat')")
            ->get();

        $jadwalBilal = JadwalBilal::with('anggota')
            ->get()
            ->sortBy(fn ($item) => array_search($item->pasaran, ['legi', 'pahing', 'pon', 'wage', 'kliwon']));

        $jadwalPiket = JadwalPiketKebersihan::with('anggota')
            ->get()
            ->sortBy(fn ($item) => array_search($item->hari, ['senin','selasa','rabu','kamis','jumat','sabtu','minggu']));

        return view('landing', compact(
            'pengumuman',
            'jadwalImamMuazin',
            'jadwalBilal',
            'jadwalPiket',
            'jumlahPengurus',
            'jumlahPengumuman',
            'jumlahJadwal',
            'jumlahKegiatan'
        ));
    }
}