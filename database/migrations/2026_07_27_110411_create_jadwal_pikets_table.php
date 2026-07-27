<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_pikets', function (Blueprint $table) {

            $table->id();

            $table->foreignId('anggota_id')
                ->constrained('anggotas')
                ->cascadeOnDelete();

            $table->string('hari');

            $table->date('tanggal');

            $table->time('jam_mulai');

            $table->time('jam_selesai');

            $table->text('tugas')->nullable();

            $table->enum('status', ['Aktif','Selesai'])
                ->default('Aktif');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_pikets');
    }
};