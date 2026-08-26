<?php

namespace App\Models;

use App\Models\Concerns\HasPresensi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class JadwalJumat extends Model
{
    use HasPresensi;

    protected $table = 'jadwal_jumats';

    protected $fillable = ['pasaran', 'keterangan'];

    public function khatib(): BelongsToMany
    {
        return $this->belongsToMany(Pengurus::class, 'jadwal_jumat_anggotas')
            ->wherePivot('peran', 'khatib')
            ->withPivot('urutan')
            ->orderByPivot('urutan')
            ->withTimestamps();
    }

    public function imam(): BelongsToMany
    {
        return $this->belongsToMany(Pengurus::class, 'jadwal_jumat_anggotas')
            ->wherePivot('peran', 'imam')
            ->withPivot('urutan')
            ->orderByPivot('urutan')
            ->withTimestamps();
    }

    public function bilal(): BelongsToMany
    {
        return $this->belongsToMany(Pengurus::class, 'jadwal_jumat_anggotas')
            ->wherePivot('peran', 'bilal')
            ->withPivot('urutan')
            ->orderByPivot('urutan')
            ->withTimestamps();
    }
}