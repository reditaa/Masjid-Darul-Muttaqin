<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jadwal_imam_muazin_anggotas', function (Blueprint $table) {
            // Hapus unique constraint lama yang tidak menghitung kolom 'peran'
            $table->dropUnique('imam_anggota_unique');

            // Buat unique constraint baru: satu orang boleh jadi imam DAN muazin
            // di jadwal yang sama, tapi tidak boleh dobel untuk peran yang sama
            $table->unique(
                ['jadwal_imam_muazin_id', 'pengurus_id', 'peran'],
                'jadwal_imam_muazin_anggota_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::table('jadwal_imam_muazin_anggotas', function (Blueprint $table) {
            $table->dropUnique('jadwal_imam_muazin_anggota_unique');
            $table->unique(['jadwal_imam_muazin_id', 'pengurus_id'], 'imam_anggota_unique');
        });
    }
};