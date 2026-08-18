<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_jumats', function (Blueprint $table) {
            $table->id();
            $table->enum('pasaran', ['legi', 'pahing', 'pon', 'wage', 'kliwon'])->unique();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        Schema::create('jadwal_jumat_anggotas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jadwal_jumat_id')->constrained('jadwal_jumats')->cascadeOnDelete();
            $table->foreignId('pengurus_id')->constrained('pengurus')->cascadeOnDelete();
            $table->enum('peran', ['khatib', 'imam']);
            $table->unsignedTinyInteger('urutan')->default(1);
            $table->timestamps();

            $table->unique(['jadwal_jumat_id', 'pengurus_id', 'peran'], 'jumat_anggota_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_jumat_anggotas');
        Schema::dropIfExists('jadwal_jumats');
    }
};