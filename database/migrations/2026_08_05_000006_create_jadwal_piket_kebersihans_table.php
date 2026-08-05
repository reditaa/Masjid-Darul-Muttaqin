<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_piket_kebersihans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_regu');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->text('area_tugas')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_piket_kebersihans');
    }
};