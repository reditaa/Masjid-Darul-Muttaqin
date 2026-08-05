<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JadwalPiketAnggota extends Model
{
    protected $table = 'jadwal_piket_anggotas';

    protected $fillable = ['jadwal_piket_kebersihan_id', 'pengurus_id'];

    public function jadwalPiket(): BelongsTo
    {
        return $this->belongsTo(JadwalPiketKebersihan::class, 'jadwal_piket_kebersihan_id');
    }

    public function pengurus(): BelongsTo
    {
        return $this->belongsTo(Pengurus::class);
    }
}