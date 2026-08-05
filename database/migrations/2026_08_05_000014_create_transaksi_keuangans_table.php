<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi_keuangans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_transaksi_id')->constrained('kategori_transaksis')->cascadeOnDelete();
            $table->enum('jenis', ['pemasukan', 'pengeluaran']);
            $table->date('tanggal');
            $table->decimal('jumlah', 15, 2);
            $table->string('sumber_tujuan')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('bukti')->nullable();
            $table->foreignId('dicatat_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('kegiatan_id')->nullable()->constrained('kegiatans')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi_keuangans');
    }
};
