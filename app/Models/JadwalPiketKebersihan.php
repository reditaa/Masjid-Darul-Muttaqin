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

    protected $fillable = [
        'nama_regu', 'tanggal_mulai', 'tanggal_selesai', 'area_tugas', 'keterangan',
    ];

    protected $casts = [
        'tanggal_mulai'   => 'date',
        'tanggal_selesai' => 'date',
    ];

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

    public function scopeMingguIni($query)
    {
        return $query->where('tanggal_mulai', '<=', now())
            ->where('tanggal_selesai', '>=', now());
    }
}