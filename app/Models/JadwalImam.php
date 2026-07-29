<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalImam extends Model
{
    protected $fillable = [
        'tanggal',
        'imam_id',
        'keterangan',
    ];

    public function imam()
    {
        return $this->belongsTo(Pengurus::class, 'imam_id');
    }
}