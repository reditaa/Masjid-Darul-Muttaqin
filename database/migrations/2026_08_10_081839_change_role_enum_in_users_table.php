<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Langkah 1: perluas dulu pilihannya supaya 'anggota' bisa dipakai sementara
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'siswa', 'anggota') NOT NULL DEFAULT 'siswa'");

        // Langkah 2: pindahkan data lama 'siswa' jadi 'anggota'
        DB::statement("UPDATE users SET role = 'anggota' WHERE role = 'siswa'");

        // Langkah 3: persempit lagi ke pilihan final
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'anggota') NOT NULL DEFAULT 'anggota'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'siswa') NOT NULL DEFAULT 'siswa'");
    }
};