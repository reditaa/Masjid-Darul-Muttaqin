<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galeris', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('file');
            $table->enum('tipe', ['foto', 'video'])->default('foto');
            $table->foreignId('galeri_kategori_id')->nullable()->constrained('galeri_kategoris')->nullOnDelete();
            $table->foreignId('kegiatan_id')->nullable()->constrained('kegiatans')->nullOnDelete();
            $table->date('tanggal');
            $table->foreignId('diunggah_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galeris');
    }
};