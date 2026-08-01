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



            // Khatib Jumat

            $table->foreignId('khatib_id')
                ->constrained('pengurus')
                ->cascadeOnDelete();



            // Imam Jumat

            $table->foreignId('imam_id')
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