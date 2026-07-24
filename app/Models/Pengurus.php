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
}