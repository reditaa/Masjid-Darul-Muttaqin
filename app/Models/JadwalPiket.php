<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalPiket extends Model
{
    protected $table = 'jadwal_pikets';

    protected $fillable = [
        'hari',
        'koordinator_id',
        'anggota1_id',
        'anggota2_id',
        'anggota3_id',
        'anggota4_id',
        'keterangan',
    ];

    public function koordinator()
    {
        return $this->belongsTo(Pengurus::class, 'koordinator_id');
    }

    public function anggota1()
    {
        return $this->belongsTo(Pengurus::class, 'anggota1_id');
    }

    public function anggota2()
    {
        return $this->belongsTo(Pengurus::class, 'anggota2_id');
    }

    public function anggota3()
    {
        return $this->belongsTo(Pengurus::class, 'anggota3_id');
    }

    public function anggota4()
    {
        return $this->belongsTo(Pengurus::class, 'anggota4_id');
    }
}