<?php

namespace Database\Seeders;

use App\Models\KategoriTransaksi;
use Illuminate\Database\Seeder;

class KategoriTransaksiSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = [
            // Pemasukan
            ['nama_kategori' => 'Infaq Jumat', 'jenis' => 'pemasukan'],
            ['nama_kategori' => 'Donasi', 'jenis' => 'pemasukan'],
            ['nama_kategori' => 'Zakat', 'jenis' => 'pemasukan'],
            ['nama_kategori' => 'Wakaf', 'jenis' => 'pemasukan'],
            ['nama_kategori' => 'Lainnya (Pemasukan)', 'jenis' => 'pemasukan'],

            // Pengeluaran
            ['nama_kategori' => 'Operasional Masjid', 'jenis' => 'pengeluaran'],
            ['nama_kategori' => 'Listrik & Air', 'jenis' => 'pengeluaran'],
            ['nama_kategori' => 'Pemeliharaan & Perbaikan', 'jenis' => 'pengeluaran'],
            ['nama_kategori' => 'Kegiatan & Acara', 'jenis' => 'pengeluaran'],
            ['nama_kategori' => 'Santunan', 'jenis' => 'pengeluaran'],
            ['nama_kategori' => 'Lainnya (Pengeluaran)', 'jenis' => 'pengeluaran'],
        ];

        foreach ($kategoris as $kategori) {
            KategoriTransaksi::firstOrCreate(
                ['nama_kategori' => $kategori['nama_kategori']],
                ['jenis' => $kategori['jenis']]
            );
        }
    }
}