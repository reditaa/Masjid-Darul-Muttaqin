<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_piket_anggotas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jadwal_piket_kebersihan_id')
                ->constrained('jadwal_piket_kebersihans')
                ->cascadeOnDelete();
            $table->foreignId('pengurus_id')->constrained('pengurus')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(
                ['jadwal_piket_kebersihan_id', 'pengurus_id'],
                'piket_anggota_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_piket_anggotas');
    }
};