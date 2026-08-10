<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use App\Models\Pengurus;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PengurusSeeder extends Seeder
{
    public function run(): void
    {
        $dataPengurus = [
            [
                'jabatan' => 'Ketua',
                'nama' => 'Ketua DKM',
                'jenis_kelamin' => 'L',
            ],
            [
                'jabatan' => 'Wakil Ketua',
                'nama' => 'Wakil Ketua DKM',
                'jenis_kelamin' => 'L',
            ],
            [
                'jabatan' => 'Sekretaris',
                'nama' => 'Sekretaris DKM',
                'jenis_kelamin' => 'L',
            ],
            [
                'jabatan' => 'Bendahara',
                'nama' => 'Bendahara DKM',
                'jenis_kelamin' => 'P',
            ],
            [
                'jabatan' => 'Humas',
                'nama' => 'Humas DKM',
                'jenis_kelamin' => 'L',
            ],
        ];

        foreach ($dataPengurus as $data) {
            $jabatan = Jabatan::where(
                'nama_jabatan',
                $data['jabatan']
            )->first();

            if (!$jabatan) {
                continue;
            }

            Pengurus::firstOrCreate(
                [
                    'nama' => $data['nama'],
                ],
                [
                    'jabatan_id' => $jabatan->id,
                    'jenis_kelamin' => $data['jenis_kelamin'],
                    'status' => 'aktif',
                    'periode_mulai' => Carbon::today(),
                    'periode_selesai' => null,
                ]
            );
        }
    }
}
