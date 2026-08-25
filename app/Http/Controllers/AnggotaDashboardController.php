<?php

namespace App\Http\Controllers;

use App\Models\JadwalBilal;
use App\Models\JadwalImamMuazin;
use App\Models\JadwalJumat;
use App\Models\JadwalPiketKebersihan;
use App\Models\Kegiatan;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\Auth;

class AnggotaDashboardController extends Controller
{
    private const URUTAN_HARI = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'];

    public function index()
    {
        $pengurus = Auth::user()->pengurus;
        $pengurusId = $pengurus?->id;

        $hariIni = strtolower(now()->translatedFormat('l'));
        $pasaranIni = $this->pasaranHariIni();
        $isJumat = $hariIni === 'jumat';

        // Imam & Muazin - SELURUH jadwal, ditandai mana milik sendiri & mana yang hari ini
        $jadwalImam = JadwalImamMuazin::with('anggota')
            ->get()
            ->map(function ($j) use ($pengurusId, $hariIni) {
                $j->milik_saya = $pengurusId && $j->anggota->contains('id', $pengurusId);
                $j->hari_ini = $j->hari === $hariIni;
                return $j;
            })
            ->sortBy(fn ($j) => array_search($j->hari, self::URUTAN_HARI))
            ->values();

        // Jumat (Khatib & Imam)
        $jadwalJumat = JadwalJumat::with(['khatib', 'imam'])
            ->get()
            ->map(function ($jj) use ($pengurusId, $pasaranIni, $isJumat) {
                $jj->milik_saya = $pengurusId && (
                    $jj->khatib->contains('id', $pengurusId) || $jj->imam->contains('id', $pengurusId)
                );
                $jj->hari_ini = $isJumat && $jj->pasaran === $pasaranIni;
                return $jj;
            })
            ->sortBy(fn ($jj) => array_search($jj->pasaran, JadwalBilal::PASARAN_URUTAN))
            ->values();

        // Bilal
        $jadwalBilal = JadwalBilal::with('anggota')
            ->get()
            ->map(function ($jb) use ($pengurusId, $pasaranIni) {
                $jb->milik_saya = $pengurusId && $jb->anggota->contains('id', $pengurusId);
                $jb->hari_ini = $jb->pasaran === $pasaranIni;
                return $jb;
            })
            ->sortBy(fn ($jb) => array_search($jb->pasaran, JadwalBilal::PASARAN_URUTAN))
            ->values();

        // Piket Kebersihan
        $jadwalPiket = JadwalPiketKebersihan::with('anggota')
            ->get()
            ->map(function ($jp) use ($pengurusId, $hariIni) {
                $jp->milik_saya = $pengurusId && $jp->anggota->contains('id', $pengurusId);
                $jp->hari_ini = $jp->hari === $hariIni;
                return $jp;
            })
            ->sortBy(fn ($jp) => array_search($jp->hari, self::URUTAN_HARI))
            ->values();

        $pengumuman = Pengumuman::published()->latest('tanggal_publish')->take(5)->get();
        $kegiatan = Kegiatan::akanDatang()->orderBy('tanggal_mulai')->take(5)->get();

        // Ringkasan tugas pribadi hari ini (untuk banner notifikasi di atas)
        $tugasHariIni = collect()
            ->concat($jadwalImam->filter(fn ($j) => $j->milik_saya && $j->hari_ini)
                ->map(fn ($j) => 'Imam/Muazin - ' . ucfirst($j->waktu_sholat)))
            ->concat($jadwalJumat->filter(fn ($jj) => $jj->milik_saya && $jj->hari_ini)
                ->map(fn () => 'Jumat - Khatib/Imam'))
            ->concat($jadwalBilal->filter(fn ($jb) => $jb->milik_saya && $jb->hari_ini)
                ->map(fn ($jb) => 'Bilal - Pasaran ' . ucfirst($jb->pasaran)))
            ->concat($jadwalPiket->filter(fn ($jp) => $jp->milik_saya && $jp->hari_ini)
                ->map(fn () => 'Piket Kebersihan'))
            ->values();

        return view('anggota.dashboard', compact(
            'pengurus', 'jadwalImam', 'jadwalJumat', 'jadwalBilal', 'jadwalPiket',
            'pengumuman', 'kegiatan', 'tugasHariIni'
        ));
    }

    private function pasaranHariIni(): string
    {
        $tanggal = now();
        $jdn = gregoriantojd((int) $tanggal->format('n'), (int) $tanggal->format('j'), (int) $tanggal->format('Y'));

        return JadwalBilal::PASARAN_URUTAN[$jdn % 5];
    }
}