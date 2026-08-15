<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_imam_muazins', function (Blueprint $table) {
            $table->id();
            $table->enum('hari', ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu']);
            $table->enum('waktu_sholat', ['subuh', 'dzuhur', 'ashar', 'maghrib', 'isya', 'jumat']);
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->unique(['hari', 'waktu_sholat']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_imam_muazins');
    }
};