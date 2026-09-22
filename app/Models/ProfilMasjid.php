<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilMasjid extends Model
{
    protected $table = 'profil_masjid';

    protected $fillable = [
        'nama_masjid', 'sub_judul', 'slogan', 'footer_text', 'deskripsi', 'alamat', 'kelurahan', 'kecamatan',
        'kabupaten_kota', 'provinsi', 'kode_pos', 'latitude', 'longitude',
        'no_telepon', 'email', 'instagram', 'tiktok',
        'tahun_berdiri', 'luas_tanah',
        'luas_bangunan', 'kapasitas_jamaah', 'sejarah', 'visi', 'misi',
        'logo', 'foto_utama', 'foto_hero',
        'teks_statistik', 'teks_pengumuman', 'teks_kegiatan',
        'teks_jadwal_imam_muazin', 'teks_jadwal_jumat', 'teks_jadwal_bilal',
        'teks_jadwal_piket', 'teks_galeri', 'teks_inventaris',
        'judul_statistik', 'judul_pengumuman', 'judul_kegiatan',
        'judul_jadwal_imam_muazin', 'judul_jadwal_jumat', 'judul_jadwal_bilal',
        'judul_jadwal_piket', 'judul_galeri', 'judul_inventaris',
    ];

    protected $casts = [
        'latitude'  => 'decimal:7',
        'longitude' => 'decimal:7',
        'luas_tanah' => 'decimal:2',
        'luas_bangunan' => 'decimal:2',
    ];

    public static function current(): ?self
    {
        return static::first();
    }
}