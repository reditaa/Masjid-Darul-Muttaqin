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

        $imam = Pengurus::where('jabatan','Imam')
            ->take(3)
            ->get();


        if($imam->count() < 3){

            return;

        }


        // JADWAL SHOLAT MAKTUBAH

        JadwalImam::create([

            'jenis_jadwal' => 'Maktubah',

            'hari' => 'Senin',

            'waktu_sholat' => 'Dzuhur',

            'imam_1' => $imam[0]->id,

            'imam_2' => $imam[1]->id,

            'imam_3' => $imam[2]->id,

        ]);



        JadwalImam::create([

            'jenis_jadwal' => 'Maktubah',

            'hari' => 'Selasa',

            'waktu_sholat' => 'Ashar',

            'imam_1' => $imam[1]->id,

            'imam_2' => $imam[2]->id,

            'imam_3' => $imam[0]->id,

        ]);




        // JADWAL JUMAT

        JadwalJumat::create([

            'pasaran'=>'Pon',

            'imam_1'=>$imam[0]->id,

            'imam_2'=>$imam[1]->id,

        ]);

    }

}