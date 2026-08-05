<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventaris', function (Blueprint $table) {
            $table->id();
            $table->string('kode_inventaris')->unique();
            $table->string('nama_barang');
            $table->enum('kategori', [
                'elektronik', 'mebel', 'perlengkapan_ibadah', 'kebersihan', 'dokumen', 'lainnya',
            ])->default('lainnya');
            $table->unsignedInteger('jumlah')->default(1);
            $table->string('satuan')->default('unit');
            $table->enum('kondisi', ['baik', 'rusak_ringan', 'rusak_berat', 'hilang'])->default('baik');
            $table->string('lokasi_penyimpanan')->nullable();
            $table->date('tanggal_perolehan')->nullable();
            $table->enum('sumber_perolehan', ['pembelian', 'donasi', 'hibah', 'lainnya'])->default('lainnya');
            $table->decimal('harga_perolehan', 15, 2)->nullable();
            $table->string('foto')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventaris');
    }
};