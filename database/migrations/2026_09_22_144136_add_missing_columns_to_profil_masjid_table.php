<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profil_masjid', function (Blueprint $table) {
            if (!Schema::hasColumn('profil_masjid', 'sub_judul')) {
                $table->string('sub_judul')->nullable()->after('nama_masjid');
            }
            if (!Schema::hasColumn('profil_masjid', 'footer_text')) {
                $table->text('footer_text')->nullable()->after('slogan');
            }
            if (!Schema::hasColumn('profil_masjid', 'instagram')) {
                $table->string('instagram')->nullable();
            }
            if (!Schema::hasColumn('profil_masjid', 'tiktok')) {
                $table->string('tiktok')->nullable();
            }
            if (!Schema::hasColumn('profil_masjid', 'no_telepon')) {
                $table->string('no_telepon')->nullable();
            }
            if (!Schema::hasColumn('profil_masjid', 'email')) {
                $table->string('email')->nullable();
            }
            if (!Schema::hasColumn('profil_masjid', 'logo')) {
                $table->string('logo')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('profil_masjid', function (Blueprint $table) {
            foreach (['sub_judul', 'footer_text', 'instagram', 'tiktok', 'no_telepon', 'email', 'logo'] as $col) {
                if (Schema::hasColumn('profil_masjid', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};