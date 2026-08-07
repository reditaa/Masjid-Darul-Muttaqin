<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_bilal_anggotas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jadwal_bilal_id')->constrained('jadwal_bilals')->cascadeOnDelete();
            $table->foreignId('pengurus_id')->constrained('pengurus')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['jadwal_bilal_id', 'pengurus_id'], 'bilal_anggota_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_bilal_anggotas');
    }
};