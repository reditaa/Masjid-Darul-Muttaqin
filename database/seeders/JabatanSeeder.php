<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    public function run(): void
    {
        $jabatans = [
            'Ketua DKM',
            'Wakil Ketua DKM',
            'Sekretaris',
            'Wakil Sekretaris',
            'Bendahara',
            'Wakil Bendahara',
            'Koordinator Bidang Ibadah',
            'Koordinator Bidang Pendidikan & Dakwah',
            'Koordinator Bidang Kebersihan & Sarana',
            'Koordinator Bidang Sosial & Kemasyarakatan',
            'Imam Tetap',
            'Muazin',
            'Anggota',
        ];

        foreach ($jabatans as $urutan => $nama) {
            Jabatan::firstOrCreate(
                ['nama_jabatan' => $nama],
                ['urutan' => $urutan + 1]
            );
        }
    }
}