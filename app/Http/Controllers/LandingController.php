<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use App\Models\Pengumuman;
use App\Models\JadwalImamMuazin;
use App\Models\JadwalBilal;
use App\Models\JadwalPiketKebersihan;
use App\Models\Kegiatan;
use App\Models\Galeri;
use App\Models\Inventaris;
use App\Models\ProfilMasjid;

class LandingController extends Controller
{
    public function index()
    {
        $profil = ProfilMasjid::current();

        $jumlahPengurus = Pengurus::count();
        $jumlahPengumuman = Pengumuman::published()->count();
        $jumlahJadwal = JadwalImamMuazin::count();
        $jumlahKegiatan = Kegiatan::count();

        $pengumuman = Pengumuman::published()
            ->latest('tanggal_publish')
            ->take(3)
            ->get();

        $jadwalImamMuazin = JadwalImamMuazin::with('anggota')
            ->orderByRaw("FIELD(hari, 'senin','selasa','rabu','kamis','jumat','sabtu','minggu')")
            ->orderByRaw("FIELD(waktu_sholat, 'subuh','dzuhur','ashar','maghrib','isya','jumat')")
            ->get();

        $jadwalBilal = JadwalBilal::with('anggota')
            ->get()
            ->sortBy(fn ($item) => array_search($item->pasaran, ['legi', 'pahing', 'pon', 'wage', 'kliwon']));

        $jadwalPiket = JadwalPiketKebersihan::with('anggota')
            ->get()
            ->sortBy(fn ($item) => array_search($item->hari, ['senin','selasa','rabu','kamis','jumat','sabtu','minggu']));

        // Kegiatan terbaru / akan datang
        $kegiatan = Kegiatan::orderByDesc('tanggal_mulai')
            ->take(6)
            ->get();

        // Galeri terbaru
        $galeri = Galeri::latest('tanggal')
            ->take(8)
            ->get();

        // Inventaris
        $inventaris = Inventaris::orderBy('nama_barang')
            ->take(10)
            ->get();
        $jumlahInventaris = Inventaris::count();

        return view('landing', compact(
            'profil',
            'pengumuman',
            'jadwalImamMuazin',
            'jadwalBilal',
            'jadwalPiket',
            'kegiatan',
            'galeri',
            'inventaris',
            'jumlahPengurus',
            'jumlahPengumuman',
            'jumlahJadwal',
            'jumlahKegiatan',
            'jumlahInventaris'
        ));
    }
}