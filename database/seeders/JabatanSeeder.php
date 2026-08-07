<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    public function run(): void
    {
        $jabatans = [
            'Ketua',
            'Wakil Ketua',
            'Sekretaris',
            'Bendahara',
            'Humas',
            'Dokumentasi',
            'Kegiatan',
            'Perlengkapan',
            'Pembina',
        ];
        foreach ($jabatans as $urutan => $nama) {
            Jabatan::firstOrCreate(
                ['nama_jabatan' => $nama],
                ['urutan' => $urutan + 1]
            );
        }
    }
}