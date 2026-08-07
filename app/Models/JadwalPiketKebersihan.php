<?php

namespace App\Models;

use App\Models\Concerns\HasPresensi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class JadwalPiketKebersihan extends Model
{
    use HasPresensi;

    protected $table = 'jadwal_piket_kebersihans';

    protected $fillable = ['hari'];

    public function anggotaPivot(): HasMany
    {
        return $this->hasMany(JadwalPiketAnggota::class);
    }

    public function anggota(): BelongsToMany
    {
        return $this->belongsToMany(
            Pengurus::class,
            'jadwal_piket_anggotas'
        )->withTimestamps();
    }
}