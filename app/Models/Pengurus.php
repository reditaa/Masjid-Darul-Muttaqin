<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengurus extends Model
{
    protected $table = 'pengurus';

    protected $fillable = [
        'anggota_id',
        'jabatan',
        'mulai_jabatan',
        'selesai_jabatan',
        'status',
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }

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

    public function getNamaAttribute()
    {
        return $this->anggota?->nama;
    }

    public function getFotoAttribute()
    {
        if (!$this->anggota) {
            return null;
        }

        return $this->anggota->jenis == 'Guru'
            ? $this->anggota->guru?->foto
            : $this->anggota->siswa?->foto;
    }

    public function getNipNisAttribute()
    {
        if (!$this->anggota) {
            return '-';
        }

        return $this->anggota->jenis == 'Guru'
            ? $this->anggota->guru?->nip
            : $this->anggota->siswa?->nis;
    }

    public function jadwalImam()
{
    return $this->hasMany(JadwalImam::class, 'imam_id');
}
}