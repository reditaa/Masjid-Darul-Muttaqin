<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Galeri extends Model
{
    protected $fillable = [
        'judul', 'deskripsi', 'file', 'tipe', 'galeri_kategori_id',
        'kegiatan_id', 'tanggal', 'diunggah_oleh',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(GaleriKategori::class, 'galeri_kategori_id');
    }

    public function kegiatan(): BelongsTo
    {
        return $this->belongsTo(Kegiatan::class);
    }

    public function pengunggah(): BelongsTo
    {
        return $this->belongsTo(User::class, 'diunggah_oleh');
    }

    public function scopeFoto($query)
    {
        return $query->where('tipe', 'foto');
    }

    public function scopeVideo($query)
    {
        return $query->where('tipe', 'video');
    }
}