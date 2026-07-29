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

            $table->date('tanggal');

            $table->foreignId('imam_id')
                ->constrained('pengurus')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->text('keterangan')->nullable();

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_imams');
    }
};