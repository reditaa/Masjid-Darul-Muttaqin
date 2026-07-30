<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengurus;
use App\Models\JadwalImam;
use App\Models\JadwalJumat;

class JadwalImamSeeder extends Seeder
{

    public function run(): void
    {

        $getImam = function($nama)
        {
            return Pengurus::whereHas('anggota.guru', function($q) use($nama){
                    $q->where('nama','like','%'.$nama.'%');
                })
                ->orWhereHas('anggota.siswa', function($q) use($nama){
                    $q->where('nama','like','%'.$nama.'%');
                })
                ->first()
                ?->id;
        };


        // DATA JADWAL NANTI KITA MASUKKAN DI SINI


    }

}