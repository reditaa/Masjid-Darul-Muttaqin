<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengurus', function (Blueprint $table) {

            $table->id();

            $table->foreignId('anggota_id')
                ->constrained('anggotas')
                ->cascadeOnDelete();

            $table->string('jabatan');

            $table->date('mulai_jabatan');

            $table->date('selesai_jabatan')->nullable();

            $table->enum('status', ['Aktif','Nonaktif'])
                ->default('Aktif');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengurus');
    }
};