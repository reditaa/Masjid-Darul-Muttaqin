<?php

namespace App\Http\Controllers;

use App\Models\JadwalBilal;
use App\Models\JadwalImamMuazin;
use App\Models\JadwalPiketKebersihan;
use App\Models\Kegiatan;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\Auth;

class AnggotaDashboardController extends Controller
{
    public function index()
    {
        $pengurus = Auth::user()->pengurus;

        $jadwalImam = $pengurus
            ? JadwalImamMuazin::where('imam_id', $pengurus->id)
                ->orWhere('muazin_id', $pengurus->id)
                ->orWhere('khatib_id', $pengurus->id)
                ->get()
            : collect();

        $jadwalBilal = $pengurus
            ? $pengurus->jadwalBilal()->with('jadwalBilal')->get()
            : collect();

        $jadwalPiket = $pengurus
            ? $pengurus->jadwalPiket()->with('jadwalPiket')->get()
            : collect();

        $pengumuman = Pengumuman::published()->latest('tanggal_publish')->take(5)->get();
        $kegiatan = Kegiatan::akanDatang()->orderBy('tanggal_mulai')->take(5)->get();

        // Cek apakah ada tugas hari ini
        $hariIni = strtolower(now()->translatedFormat('l'));
        $pasaranIni = $this->pasaranHariIni();

        $tugasHariIni = [];

        foreach ($jadwalImam as $j) {
            if ($j->hari === $hariIni) {
                $tugasHariIni[] = 'Imam/Muazin - ' . ucfirst($j->waktu_sholat);
            }
        }

        foreach ($jadwalBilal as $jb) {
            if ($jb->jadwalBilal && $jb->jadwalBilal->pasaran === $pasaranIni) {
                $tugasHariIni[] = 'Bilal - Pasaran ' . ucfirst($pasaranIni);
            }
        }

        foreach ($jadwalPiket as $jp) {
            if ($jp->jadwalPiket && $jp->jadwalPiket->hari === $hariIni) {
                $tugasHariIni[] = 'Piket Kebersihan';
            }
        }

        return view('anggota.dashboard', compact(
            'pengurus', 'jadwalImam', 'jadwalBilal', 'jadwalPiket',
            'pengumuman', 'kegiatan', 'tugasHariIni'
        ));
    }

    private function pasaranHariIni(): string
    {
        $tanggal = now();
        $jdn = gregoriantojd((int) $tanggal->format('n'), (int) $tanggal->format('j'), (int) $tanggal->format('Y'));

        $urutanPasaran = ['legi', 'pahing', 'pon', 'wage', 'kliwon'];

        return $urutanPasaran[$jdn % 5];
    }
}