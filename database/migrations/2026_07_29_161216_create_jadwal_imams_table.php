<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_imams', function (Blueprint $table) {

            $table->id();


            // Hari jadwal imam
            $table->enum('hari', [
                'Senin',
                'Selasa',
                'Rabu',
                'Kamis'
            ]);


            // Waktu sholat
            $table->enum('waktu_sholat', [
                'Dzuhur',
                'Ashar'
            ]);


            // 3 pilihan imam dari Pengurus DKM
            $table->foreignId('imam_1')
                ->constrained('pengurus')
                ->cascadeOnUpdate()
                ->restrictOnDelete();


            $table->foreignId('imam_2')
                ->constrained('pengurus')
                ->cascadeOnUpdate()
                ->restrictOnDelete();


            $table->foreignId('imam_3')
                ->constrained('pengurus')
                ->cascadeOnUpdate()
                ->restrictOnDelete();


            $table->timestamps();

        });
    }


    public function down(): void
    {
        Schema::dropIfExists('jadwal_imams');
    }
};