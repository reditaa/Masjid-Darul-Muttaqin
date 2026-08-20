<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilMasjid extends Model
{
    protected $table = 'profil_masjid';

    protected $fillable = [
        'nama_masjid', 'slogan', 'deskripsi', 'alamat', 'kelurahan', 'kecamatan',
        'kabupaten_kota', 'provinsi', 'kode_pos', 'latitude', 'longitude',
        'no_telepon', 'email', 'website', 'tahun_berdiri', 'luas_tanah',
        'luas_bangunan', 'kapasitas_jamaah', 'sejarah', 'visi', 'misi',
        'logo', 'foto_utama', 'foto_hero',
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