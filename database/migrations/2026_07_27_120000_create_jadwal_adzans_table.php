<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_adzans', function (Blueprint $table) {
            $table->id();

            $table->enum('hari', ['Senin', 'Selasa', 'Rabu', 'Kamis']);

            $table->foreignId('dzuhur_imam_id')
                ->nullable()
                ->constrained('pengurus')
                ->nullOnDelete();

            $table->foreignId('dzuhur_muadzin_id')
                ->constrained('pengurus')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('ashar_imam_id')
                ->nullable()
                ->constrained('pengurus')
                ->nullOnDelete();

            $table->foreignId('ashar_muadzin_id')
                ->constrained('pengurus')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->text('keterangan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_adzans');
    }
};