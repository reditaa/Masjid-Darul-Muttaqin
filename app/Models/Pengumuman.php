<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Pengumuman extends Model
{
     protected $table = 'pengumumans';
    protected $fillable = [
        'judul', 'slug', 'isi', 'kategori', 'gambar', 'tanggal_publish',
        'tanggal_berakhir', 'status', 'dilihat', 'penulis_id',
    ];

    protected $casts = [
        'tanggal_publish'  => 'datetime',
        'tanggal_berakhir' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (Pengumuman $item) {
            if (empty($item->slug)) {
                $item->slug = Str::slug($item->judul) . '-' . Str::random(6);
            }
        });
    }

    public function penulis(): BelongsTo
    {
        return $this->belongsTo(User::class, 'penulis_id');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
            ->where('tanggal_publish', '<=', now())
            ->where(function ($q) {
                $q->whereNull('tanggal_berakhir')
                  ->orWhere('tanggal_berakhir', '>=', now());
            });
    }

    public function scopeKategori($query, string $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    public function tambahDilihat(): void
    {
        $this->increment('dilihat');
    }
}