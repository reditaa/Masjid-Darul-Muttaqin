<?php

namespace App\Models;

use App\Models\Concerns\HasPresensi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JadwalImamMuazin extends Model
{
    use HasPresensi;

    protected $table = 'jadwal_imam_muazins';

    protected $fillable = [
        'hari', 'waktu_sholat', 'imam_id', 'khatib_id', 'muazin_id', 'keterangan',
    ];

    public function imam(): BelongsTo
    {
        return $this->belongsTo(Pengurus::class, 'imam_id');
    }

    public function khatib(): BelongsTo
    {
        return $this->belongsTo(Pengurus::class, 'khatib_id');
    }

    public function muazin(): BelongsTo
    {
        return $this->belongsTo(Pengurus::class, 'muazin_id');
    }

    public function scopeHari($query, string $hari)
    {
        return $query->where('hari', $hari);
    }
}