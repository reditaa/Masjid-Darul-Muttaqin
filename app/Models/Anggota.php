<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = 'anggotas';

    protected $fillable = [
        'guru_id',
        'siswa_id',
        'jenis',
        'status',
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function pengurus()
    {
        return $this->hasOne(Pengurus::class);
    }

    public function getNamaAttribute()
    {
        if ($this->jenis == 'Guru' && $this->guru) {
            return $this->guru->nama;
        }

        if ($this->jenis == 'Siswa' && $this->siswa) {
            return $this->siswa->nama;
        }

        return '-';
    }
}