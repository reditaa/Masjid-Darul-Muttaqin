<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_imam_muazin_anggotas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jadwal_imam_muazin_id')->constrained('jadwal_imam_muazins')->cascadeOnDelete();
            $table->foreignId('pengurus_id')->constrained('pengurus')->cascadeOnDelete();
            $table->unsignedTinyInteger('urutan')->default(1);
            $table->timestamps();

            $table->unique(['jadwal_imam_muazin_id', 'pengurus_id'], 'imam_anggota_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_imam_muazin_anggotas');
    }
};
