<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {

        Schema::table('jadwal_imams', function (Blueprint $table) {


            if (!Schema::hasColumn('jadwal_imams','dzuhur_imam_1')) {
                $table->unsignedBigInteger('dzuhur_imam_1')->nullable();
            }


            if (!Schema::hasColumn('jadwal_imams','dzuhur_imam_2')) {
                $table->unsignedBigInteger('dzuhur_imam_2')->nullable();
            }


            if (!Schema::hasColumn('jadwal_imams','dzuhur_imam_3')) {
                $table->unsignedBigInteger('dzuhur_imam_3')->nullable();
            }



            if (!Schema::hasColumn('jadwal_imams','ashar_imam_1')) {
                $table->unsignedBigInteger('ashar_imam_1')->nullable();
            }


            if (!Schema::hasColumn('jadwal_imams','ashar_imam_2')) {
                $table->unsignedBigInteger('ashar_imam_2')->nullable();
            }


            if (!Schema::hasColumn('jadwal_imams','ashar_imam_3')) {
                $table->unsignedBigInteger('ashar_imam_3')->nullable();
            }


        });

    }



    public function down(): void
    {

    }

};