<?php

namespace App\Models;

use App\Models\Concerns\HasPresensi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JadwalBilal extends Model
{
    use HasPresensi;

    protected $table = 'jadwal_bilals';

    protected $fillable = ['tanggal', 'pengurus_id', 'keterangan'];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function pengurus(): BelongsTo
    {
        return $this->belongsTo(Pengurus::class);
    }

    public function scopeAkanDatang($query)
    {
        return $query->where('tanggal', '>=', now()->toDateString());
    }
}