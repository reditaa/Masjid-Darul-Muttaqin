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

        // Hanya hitung Anggota DKM manual (asal null), bukan data sync SiPintu (guru/siswa)
        $jumlahPengurus = Pengurus::whereNull('asal')->aktif()->count();
        $jumlahPengumuman = Pengumuman::published()->count();
        $jumlahJadwal = JadwalImamMuazin::count();
        $jumlahKegiatan = Kegiatan::count();

        // Struktur pengurus (untuk modal bagan), dikelompokkan per jabatan sesuai urutan
        $strukturPengurus = Pengurus::whereNull('asal')
            ->aktif()
            ->whereNotNull('jabatan_id')
            ->with('jabatan')
            ->orderBy('nama')
            ->get()
            ->groupBy(fn ($item) => $item->jabatan->nama_jabatan)
            ->sortBy(fn ($group) => optional($group->first()->jabatan)->urutan ?? 999);

        // Pengumuman aktif (belum lewat tanggal_berakhir), maksimal 9 terbaru
        $pengumuman = Pengumuman::published()
            ->with('kegiatan')
            ->latest('tanggal_publish')
            ->take(9)
            ->get();

        $jadwalImamMuazin = JadwalImamMuazin::with(['imam', 'muazin'])
            ->orderByRaw("FIELD(hari, 'senin','selasa','rabu','kamis','jumat','sabtu','minggu')")
            ->orderByRaw("FIELD(waktu_sholat, 'subuh','dzuhur','ashar','maghrib','isya','jumat')")
            ->get();

        $jadwalBilal = JadwalBilal::with('anggota')
            ->get()
            ->sortBy(fn ($item) => array_search($item->pasaran, ['legi', 'pahing', 'pon', 'wage', 'kliwon']));

        $jadwalPiket = JadwalPiketKebersihan::with('anggota')
            ->get()
            ->sortBy(fn ($item) => array_search($item->hari, ['senin','selasa','rabu','kamis','jumat','sabtu','minggu']));

        // Kegiatan terbaru / akan datang, beserta pengumuman terkait (published saja)
        $kegiatan = Kegiatan::with(['pengumumans' => function ($q) {
                $q->published()->latest('tanggal_publish');
            }])
            ->orderByDesc('tanggal_mulai')
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
            'strukturPengurus',
            'jumlahPengumuman',
            'jumlahJadwal',
            'jumlahKegiatan',
            'jumlahInventaris'
        ));
    }
}