<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengurus extends Model
{
    protected $table = 'pengurus';

    protected $fillable = [
        'foto',
        'nama',
        'jabatan',
        'no_hp',
        'alamat',
        'mulai_jabatan',
        'selesai_jabatan',
        'status',
    ];

    public function jadwalKoordinator()
    {
        return $this->hasMany(JadwalPiket::class, 'koordinator_id');
    }

    public function jadwalAnggota1()
    {
        return $this->hasMany(JadwalPiket::class, 'anggota1_id');
    }

    public function jadwalAnggota2()
    {
        return $this->hasMany(JadwalPiket::class, 'anggota2_id');
    }

    public function jadwalAnggota3()
    {
        return $this->hasMany(JadwalPiket::class, 'anggota3_id');
    }
}