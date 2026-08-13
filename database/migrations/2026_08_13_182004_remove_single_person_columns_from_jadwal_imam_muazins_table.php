<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jadwal_imam_muazins', function (Blueprint $table) {
            $table->dropForeign(['imam_id']);
            $table->dropForeign(['khatib_id']);
            $table->dropForeign(['muazin_id']);
            $table->dropColumn(['imam_id', 'khatib_id', 'muazin_id']);
        });

        Schema::create('jadwal_imam_muazin_anggotas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jadwal_imam_muazin_id')->constrained('jadwal_imam_muazins')->cascadeOnDelete();
            $table->foreignId('pengurus_id')->constrained('pengurus')->cascadeOnDelete();
            $table->unsignedTinyInteger('urutan')->default(1);
            $table->timestamps();

            $table->unique(['jadwal_imam_muazin_id', 'pengurus_id'], 'imam_anggota_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_imam_muazin_anggotas');

        Schema::table('jadwal_imam_muazins', function (Blueprint $table) {
            $table->foreignId('imam_id')->nullable()->constrained('pengurus')->nullOnDelete();
            $table->foreignId('khatib_id')->nullable()->constrained('pengurus')->nullOnDelete();
            $table->foreignId('muazin_id')->nullable()->constrained('pengurus')->nullOnDelete();
        });
    }
};