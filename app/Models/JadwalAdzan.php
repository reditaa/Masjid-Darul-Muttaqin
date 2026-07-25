<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalAdzan extends Model
{
    protected $table = 'jadwal_adzans';

    protected $fillable = [
        'tanggal',
        'waktu',
        'muadzin',
        'imam',
        'keterangan',
    ];
}