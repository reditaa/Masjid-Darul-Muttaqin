<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('jadwal_adzans', function (Blueprint $table) {
            // Kolom baru: hari (Senin, Selasa, Rabu, Kamis)
            $table->enum('hari', ['Senin', 'Selasa', 'Rabu', 'Kamis'])
                ->nullable()
                ->after('id');

            // Kolom lama ini sudah tidak dipakai form (jadwal sekarang berbasis hari,
            // bukan tanggal spesifik + imam), jadi dibuat nullable supaya insert tidak gagal
            $table->date('tanggal')->nullable()->change();
            $table->unsignedBigInteger('dzuhur_imam_id')->nullable()->change();
            $table->unsignedBigInteger('ashar_imam_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwal_adzans', function (Blueprint $table) {
            $table->dropColumn('hari');

            $table->date('tanggal')->nullable(false)->change();
            $table->unsignedBigInteger('dzuhur_imam_id')->nullable(false)->change();
            $table->unsignedBigInteger('ashar_imam_id')->nullable(false)->change();
        });
    }
};