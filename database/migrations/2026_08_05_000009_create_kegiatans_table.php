<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kegiatans', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('deskripsi')->nullable();
            $table->enum('kategori', [
                'kajian', 'pengajian', 'phbi', 'santunan', 'bakti_sosial', 'lainnya',
            ])->default('lainnya');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai')->nullable();
            $table->time('waktu_mulai')->nullable();
            $table->time('waktu_selesai')->nullable();
            $table->string('lokasi')->nullable();
            $table->foreignId('penanggung_jawab_id')->nullable()->constrained('pengurus')->nullOnDelete();
            $table->enum('status', ['akan_datang', 'berlangsung', 'selesai', 'dibatalkan'])
                ->default('akan_datang');
            $table->string('poster')->nullable();
            $table->decimal('anggaran', 15, 2)->nullable();
            $table->unsignedInteger('jumlah_peserta')->nullable();
            $table->longText('laporan_hasil')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kegiatans');
    }
};