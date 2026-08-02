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

            $table->enum('hari', ['Senin', 'Selasa', 'Rabu', 'Kamis']);

            $table->foreignId('koordinator_id')
                ->constrained('pengurus')
                ->cascadeOnDelete();

            $table->foreignId('anggota1_id')
                ->constrained('pengurus')
                ->cascadeOnDelete();

            $table->foreignId('anggota2_id')
                ->nullable()
                ->constrained('pengurus')
                ->nullOnDelete();

            $table->foreignId('anggota3_id')
                ->nullable()
                ->constrained('pengurus')
                ->nullOnDelete();

            $table->foreignId('anggota4_id')
                ->nullable()
                ->constrained('pengurus')
                ->nullOnDelete();

            $table->text('keterangan')->nullable();

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_pikets');
    }
};