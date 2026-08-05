<?php

namespace App\Models;

use App\Models\Concerns\HasPresensi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Kegiatan extends Model
{
    use HasPresensi;

    protected $fillable = [
        'judul', 'slug', 'deskripsi', 'kategori', 'tanggal_mulai', 'tanggal_selesai',
        'waktu_mulai', 'waktu_selesai', 'lokasi', 'penanggung_jawab_id', 'status',
        'poster', 'anggaran', 'jumlah_peserta', 'laporan_hasil',
    ];

    protected $casts = [
        'tanggal_mulai'   => 'date',
        'tanggal_selesai' => 'date',
        'anggaran'        => 'decimal:2',
    ];

    protected static function booted(): void
    {
        static::creating(function (Kegiatan $item) {
            if (empty($item->slug)) {
                $item->slug = Str::slug($item->judul) . '-' . Str::random(6);
            }
        });
    }

    public function penanggungJawab(): BelongsTo
    {
        return $this->belongsTo(Pengurus::class, 'penanggung_jawab_id');
    }

    public function galeris(): HasMany
    {
        return $this->hasMany(Galeri::class);
    }

    public function transaksiKeuangans(): HasMany
    {
        return $this->hasMany(TransaksiKeuangan::class);
    }

    public function scopeAkanDatang($query)
    {
        return $query->whereIn('status', ['akan_datang', 'berlangsung']);
    }

    public function scopeRiwayat($query)
    {
        return $query->whereIn('status', ['selesai', 'dibatalkan']);
    }
}