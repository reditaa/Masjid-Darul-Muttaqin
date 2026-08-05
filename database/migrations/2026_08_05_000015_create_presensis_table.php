<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('presensis', function (Blueprint $table) {
            $table->id();

            $table->morphs('presentable'); // presentable_id, presentable_type

            $table->foreignId('pengurus_id')->constrained('pengurus')->cascadeOnDelete();

            $table->date('tanggal');

            $table->enum('status', [
                'hadir', 'tidak_hadir', 'izin', 'sakit', 'diganti',
            ])->default('hadir');

            $table->time('waktu_presensi')->nullable();
            $table->string('metode', 20)->default('manual');

            $table->foreignId('pengganti_id')->nullable()->constrained('pengurus')->nullOnDelete();

            $table->text('keterangan')->nullable();
            $table->foreignId('dicatat_oleh')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();

            $table->unique(
                ['presentable_type', 'presentable_id', 'pengurus_id', 'tanggal'],
                'presensi_unique_per_hari'
            );
            $table->index(['tanggal', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('presensis');
    }
};