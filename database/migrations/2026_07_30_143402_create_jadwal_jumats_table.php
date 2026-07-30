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

            $table->enum('pasaran', [
                'Pon',
                'Kliwon',
                'Pahing',
                'Wage',
                'Legi'
            ]);

            $table->foreignId('imam_1')
                ->constrained('pengurus')
                ->cascadeOnDelete();

            $table->foreignId('imam_2')
                ->constrained('pengurus')
                ->cascadeOnDelete();

            $table->timestamps();

        });
    }


    public function down(): void
    {
        Schema::dropIfExists('jadwal_jumats');
    }

};