<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalPiket extends Model
{
    protected $table = 'jadwal_pikets';

    protected $fillable = [
        'tanggal',
        'koordinator_id',
        'anggota1_id',
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
}