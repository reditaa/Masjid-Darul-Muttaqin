<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Anggota;
use App\Models\Pengurus;
use Carbon\Carbon;

class PengurusSeeder extends Seeder
{
    public function run(): void
    {
        $anggotas = Anggota::where('jenis', 'Guru')->get();

        foreach ($anggotas as $anggota) {

            Pengurus::firstOrCreate(
                [
                    'anggota_id' => $anggota->id,
                ],
                [
                    'jabatan' => 'Imam',
                    'mulai_jabatan' => Carbon::today(),
                    'selesai_jabatan' => null,
                    'status' => 'Aktif',
                ]
            );

        }
    }
}