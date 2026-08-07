<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jadwal_piket_kebersihans', function (Blueprint $table) {
            $table->dropColumn(['nama_regu', 'tanggal_mulai', 'tanggal_selesai']);

            $table->enum('hari', ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'])
                ->after('id');
        });

        Schema::table('jadwal_piket_kebersihans', function (Blueprint $table) {
            $table->unique('hari');
        });
    }

    public function down(): void
    {
        Schema::table('jadwal_piket_kebersihans', function (Blueprint $table) {
            $table->dropUnique(['hari']);
            $table->dropColumn('hari');

            $table->string('nama_regu')->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
        });
    }
};