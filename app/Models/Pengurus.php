<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pengurus extends Model
{
    protected $fillable = [
        'jabatan_id', 'nama', 'nik', 'jenis_kelamin', 'tempat_lahir',
        'tanggal_lahir', 'no_hp', 'email', 'alamat', 'foto', 'bio',
        'periode_mulai', 'periode_selesai', 'status', 'user_id',
    ];

    protected $casts = [
        'tanggal_lahir'   => 'date',
        'periode_mulai'   => 'date',
        'periode_selesai' => 'date',
    ];

    public function jabatan(): BelongsTo
    {
        return $this->belongsTo(Jabatan::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function jadwalSebagaiImam(): HasMany
    {
        return $this->hasMany(JadwalImamMuazin::class, 'imam_id');
    }

    public function jadwalSebagaiMuazin(): HasMany
    {
        return $this->hasMany(JadwalImamMuazin::class, 'muazin_id');
    }

    public function jadwalBilal(): HasMany
    {
        return $this->hasMany(JadwalBilal::class);
    }

    public function jadwalPiket(): HasMany
    {
        return $this->hasMany(JadwalPiketAnggota::class);
    }

    public function kegiatanDitangani(): HasMany
    {
        return $this->hasMany(Kegiatan::class, 'penanggung_jawab_id');
    }

    public function presensis(): HasMany
    {
        return $this->hasMany(Presensi::class);
    }

    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }
}