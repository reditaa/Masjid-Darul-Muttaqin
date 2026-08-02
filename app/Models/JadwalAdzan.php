<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JadwalAdzan extends Model
{
    use HasFactory;

    protected $fillable = [
        'hari',
        'dzuhur_imam_id',
        'dzuhur_muadzin_id',
        'ashar_imam_id',
        'ashar_muadzin_id',
        'keterangan',
    ];

    public function dzuhurImam(): BelongsTo
    {
        return $this->belongsTo(Pengurus::class, 'dzuhur_imam_id');
    }

    public function dzuhurMuadzin(): BelongsTo
    {
        return $this->belongsTo(Pengurus::class, 'dzuhur_muadzin_id');
    }

    public function asharImam(): BelongsTo
    {
        return $this->belongsTo(Pengurus::class, 'ashar_imam_id');
    }

    public function asharMuadzin(): BelongsTo
    {
        return $this->belongsTo(Pengurus::class, 'ashar_muadzin_id');
    }
}