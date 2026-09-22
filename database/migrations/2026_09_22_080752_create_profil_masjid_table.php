<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('profil_masjid')) {
            Schema::create('profil_masjid', function (Blueprint $table) {
                $table->id();

                $table->string('nama_masjid');
                $table->string('sub_judul')->nullable();
                $table->string('slogan')->nullable();
                $table->text('footer_text')->nullable();
                $table->text('deskripsi')->nullable();

                $table->text('alamat');
                $table->string('kelurahan')->nullable();
                $table->string('kecamatan')->nullable();
                $table->string('kabupaten_kota')->nullable();
                $table->string('provinsi')->nullable();
                $table->string('kode_pos', 10)->nullable();
                $table->decimal('latitude', 10, 7)->nullable();
                $table->decimal('longitude', 10, 7)->nullable();

                $table->string('no_telepon')->nullable();
                $table->string('email')->nullable();
                $table->string('instagram')->nullable();
                $table->string('tiktok')->nullable();

                $table->year('tahun_berdiri')->nullable();
                $table->decimal('luas_tanah', 10, 2)->nullable();
                $table->decimal('luas_bangunan', 10, 2)->nullable();
                $table->unsignedInteger('kapasitas_jamaah')->nullable();
                $table->text('sejarah')->nullable();
                $table->text('visi')->nullable();
                $table->text('misi')->nullable();

                $table->string('logo')->nullable();
                $table->string('foto_utama')->nullable();
                $table->string('foto_hero')->nullable();

                $table->string('judul_statistik')->nullable();
                $table->string('teks_statistik')->nullable();
                $table->string('judul_pengumuman')->nullable();
                $table->string('teks_pengumuman')->nullable();
                $table->string('judul_kegiatan')->nullable();
                $table->string('teks_kegiatan')->nullable();
                $table->string('judul_jadwal_imam_muazin')->nullable();
                $table->string('teks_jadwal_imam_muazin')->nullable();
                $table->string('judul_jadwal_jumat')->nullable();
                $table->string('teks_jadwal_jumat')->nullable();
                $table->string('judul_jadwal_bilal')->nullable();
                $table->string('teks_jadwal_bilal')->nullable();
                $table->string('judul_jadwal_piket')->nullable();
                $table->string('teks_jadwal_piket')->nullable();
                $table->string('judul_galeri')->nullable();
                $table->string('teks_galeri')->nullable();
                $table->string('judul_inventaris')->nullable();
                $table->string('teks_inventaris')->nullable();

                $table->timestamps();
            });

            return;
        }

        // Tabel sudah ada (dibuat migration lama) — tambahkan kolom yang belum ada saja.
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
            if (!Schema::hasColumn('profil_masjid', 'foto_hero')) {
                $table->string('foto_hero')->nullable();
            }
            if (!Schema::hasColumn('profil_masjid', 'deskripsi')) {
                $table->text('deskripsi')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profil_masjid');
    }
};