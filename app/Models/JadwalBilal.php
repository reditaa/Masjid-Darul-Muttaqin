<?php

namespace App\Models;

use App\Models\Concerns\HasPresensi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class JadwalBilal extends Model
{
    use HasPresensi;

    protected $table = 'jadwal_bilals';

    protected $fillable = ['pasaran'];

    public const PASARAN_URUTAN = ['legi', 'pahing', 'pon', 'wage', 'kliwon'];

    public function anggotaPivot(): HasMany
    {
        return $this->hasMany(JadwalBilalAnggota::class);
    }

    public function anggota(): BelongsToMany
    {
        return $this->belongsToMany(
            Pengurus::class,
            'jadwal_bilal_anggotas'
        )->withTimestamps();
    }

    public function getLabelPasaranAttribute(): string
    {
        return ucfirst($this->pasaran);
    }
}