<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_bilals', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->foreignId('pengurus_id')->constrained('pengurus')->cascadeOnDelete();
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->unique('tanggal');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_bilals');
    }
};