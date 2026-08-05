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
        Schema::table('jadwal_pikets', function (Blueprint $table) {
            // Kolom baru sesuai form Jadwal Piket (per tim)
            $table->unsignedBigInteger('koordinator_id')->nullable()->after('id');
            $table->unsignedBigInteger('anggota1_id')->nullable()->after('koordinator_id');
            $table->unsignedBigInteger('anggota2_id')->nullable()->after('anggota1_id');
            $table->unsignedBigInteger('anggota3_id')->nullable()->after('anggota2_id');
            $table->unsignedBigInteger('anggota4_id')->nullable()->after('anggota3_id');
            $table->text('keterangan')->nullable()->after('anggota4_id');

            // Kolom lama sudah tidak dipakai form ini, dibuat nullable
            // supaya insert tidak gagal
            $table->unsignedBigInteger('anggota_id')->nullable()->change();
            $table->date('tanggal')->nullable()->change();
            $table->time('jam_mulai')->nullable()->change();
            $table->time('jam_selesai')->nullable()->change();
            $table->string('tugas')->nullable()->change();
            $table->string('status')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwal_pikets', function (Blueprint $table) {
            $table->dropColumn([
                'koordinator_id',
                'anggota1_id',
                'anggota2_id',
                'anggota3_id',
                'anggota4_id',
                'keterangan',
            ]);

            $table->unsignedBigInteger('anggota_id')->nullable(false)->change();
            $table->date('tanggal')->nullable(false)->change();
            $table->time('jam_mulai')->nullable(false)->change();
            $table->time('jam_selesai')->nullable(false)->change();
            $table->string('tugas')->nullable(false)->change();
            $table->string('status')->nullable(false)->change();
        });
    }
};