<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengumumans', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->longText('isi');
            $table->enum('kategori', ['umum', 'kegiatan', 'keuangan', 'sosial', 'lainnya'])->default('umum');
            $table->string('gambar')->nullable();
            $table->dateTime('tanggal_publish');
            $table->dateTime('tanggal_berakhir')->nullable();
            $table->enum('status', ['draft', 'published', 'arsip'])->default('draft');
            $table->unsignedInteger('dilihat')->default(0);
            $table->foreignId('penulis_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengumumans');
    }
};