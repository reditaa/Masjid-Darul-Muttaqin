<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profil_masjid', function (Blueprint $table) {
            $table->string('foto_hero')->nullable()->after('foto_utama');
            $table->text('deskripsi')->nullable()->after('slogan');
        });
    }

    public function down(): void
    {
        Schema::table('profil_masjid', function (Blueprint $table) {
            $table->dropColumn(['foto_hero', 'deskripsi']);
        });
    }
};
