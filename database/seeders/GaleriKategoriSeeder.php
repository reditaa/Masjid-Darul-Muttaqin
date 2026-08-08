<?php

namespace Database\Seeders;

use App\Models\GaleriKategori;
use Illuminate\Database\Seeder;

class GaleriKategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = [
            'Kegiatan Masjid',
            'Renovasi & Pembangunan',
            'Kajian & Pengajian',
            'PHBI',
            'Santunan & Bakti Sosial',
            'Dokumentasi Umum',
        ];

        foreach ($kategoris as $nama) {
            GaleriKategori::firstOrCreate(['nama_kategori' => $nama]);
        }
    }
}