<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Anggota extends Authenticatable
{
    use Notifiable;

    protected $table = 'anggotas';

    protected $fillable = [
        'guru_id',
        'siswa_id',
        'jenis',
        'status',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
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