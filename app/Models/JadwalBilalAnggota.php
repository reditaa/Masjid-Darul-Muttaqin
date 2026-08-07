<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JadwalBilalAnggota extends Model
{
    protected $table = 'jadwal_bilal_anggotas';

    protected $fillable = ['jadwal_bilal_id', 'pengurus_id'];

    public function jadwalBilal(): BelongsTo
    {
        return $this->belongsTo(JadwalBilal::class);
    }

    public function pengurus(): BelongsTo
    {
        return $this->belongsTo(Pengurus::class);
    }
}