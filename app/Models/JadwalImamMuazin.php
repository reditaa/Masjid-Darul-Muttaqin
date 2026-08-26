<?php

namespace App\Models;

use App\Models\Concerns\HasPresensi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class JadwalImamMuazin extends Model
{
    use HasPresensi;

    protected $table = 'jadwal_imam_muazins';

    protected $fillable = ['hari', 'waktu_sholat', 'keterangan'];

    public function imam(): BelongsToMany
    {
        return $this->belongsToMany(
            Pengurus::class,
            'jadwal_imam_muazin_anggotas'
        )
            ->wherePivot('peran', 'imam')
            ->withPivot('urutan', 'peran')
            ->orderByPivot('urutan')
            ->withTimestamps();
    }

    public function muazin(): BelongsToMany
    {
        return $this->belongsToMany(
            Pengurus::class,
            'jadwal_imam_muazin_anggotas'
        )
            ->wherePivot('peran', 'muazin')
            ->withPivot('urutan', 'peran')
            ->orderByPivot('urutan')
            ->withTimestamps();
    }

    public function scopeHari($query, string $hari)
    {
        return $query->where('hari', $hari);
    }
        public function pengurus(): BelongsToMany
    {
        return $this->belongsToMany(Pengurus::class, 'jadwal_imam_muazin_anggotas')
            ->withPivot('urutan', 'peran')
            ->withTimestamps();
    }
}