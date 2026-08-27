<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jadwal_imam_muazin_anggotas', function (Blueprint $table) {
            $table->dropForeign('jadwal_imam_muazin_anggotas_jadwal_imam_muazin_id_foreign');

            $table->dropUnique('imam_anggota_unique');

            $table->unique(
                ['jadwal_imam_muazin_id', 'pengurus_id', 'peran'],
                'jadwal_imam_muazin_anggota_unique'
            );

            $table->foreign('jadwal_imam_muazin_id', 'jadwal_imam_muazin_anggotas_jadwal_imam_muazin_id_foreign')
                ->references('id')->on('jadwal_imam_muazins')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('jadwal_imam_muazin_anggotas', function (Blueprint $table) {
            $table->dropForeign('jadwal_imam_muazin_anggotas_jadwal_imam_muazin_id_foreign');

            $table->dropUnique('jadwal_imam_muazin_anggota_unique');

            $table->unique(['jadwal_imam_muazin_id', 'pengurus_id'], 'imam_anggota_unique');

            $table->foreign('jadwal_imam_muazin_id', 'jadwal_imam_muazin_anggotas_jadwal_imam_muazin_id_foreign')
                ->references('id')->on('jadwal_imam_muazins')
                ->cascadeOnDelete();
        });
    }
};