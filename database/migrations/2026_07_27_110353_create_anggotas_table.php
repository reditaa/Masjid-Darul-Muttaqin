<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('anggotas', function (Blueprint $table) {

            $table->id();

            $table->foreignId('guru_id')
                ->nullable()
                ->constrained('gurus')
                ->nullOnDelete();

            $table->foreignId('siswa_id')
                ->nullable()
                ->constrained('siswas')
                ->nullOnDelete();

            $table->enum('jenis', ['Guru', 'Siswa']);

            $table->enum('status', ['Aktif', 'Nonaktif'])
                ->default('Aktif');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anggotas');
    }
};