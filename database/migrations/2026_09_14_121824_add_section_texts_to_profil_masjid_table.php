<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profil_masjid', function (Blueprint $table) {
            $table->string('judul_statistik')->nullable()->after('misi');
            $table->string('teks_statistik')->nullable()->after('judul_statistik');

            $table->string('judul_pengumuman')->nullable()->after('teks_statistik');
            $table->string('teks_pengumuman')->nullable()->after('judul_pengumuman');

            $table->string('judul_kegiatan')->nullable()->after('teks_pengumuman');
            $table->string('teks_kegiatan')->nullable()->after('judul_kegiatan');

            $table->string('judul_jadwal_imam_muazin')->nullable()->after('teks_kegiatan');
            $table->string('teks_jadwal_imam_muazin')->nullable()->after('judul_jadwal_imam_muazin');

            $table->string('judul_jadwal_jumat')->nullable()->after('teks_jadwal_imam_muazin');
            $table->string('teks_jadwal_jumat')->nullable()->after('judul_jadwal_jumat');

            $table->string('judul_jadwal_bilal')->nullable()->after('teks_jadwal_jumat');
            $table->string('teks_jadwal_bilal')->nullable()->after('judul_jadwal_bilal');

            $table->string('judul_jadwal_piket')->nullable()->after('teks_jadwal_bilal');
            $table->string('teks_jadwal_piket')->nullable()->after('judul_jadwal_piket');

            $table->string('judul_galeri')->nullable()->after('teks_jadwal_piket');
            $table->string('teks_galeri')->nullable()->after('judul_galeri');

            $table->string('judul_inventaris')->nullable()->after('teks_galeri');
            $table->string('teks_inventaris')->nullable()->after('judul_inventaris');
        });
    }

    public function down(): void
    {
        Schema::table('profil_masjid', function (Blueprint $table) {
            $table->dropColumn([
                'judul_statistik', 'teks_statistik',
                'judul_pengumuman', 'teks_pengumuman',
                'judul_kegiatan', 'teks_kegiatan',
                'judul_jadwal_imam_muazin', 'teks_jadwal_imam_muazin',
                'judul_jadwal_jumat', 'teks_jadwal_jumat',
                'judul_jadwal_bilal', 'teks_jadwal_bilal',
                'judul_jadwal_piket', 'teks_jadwal_piket',
                'judul_galeri', 'teks_galeri',
                'judul_inventaris', 'teks_inventaris',
            ]);
        });
    }
};