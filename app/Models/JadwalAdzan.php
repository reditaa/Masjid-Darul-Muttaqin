<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalAdzan extends Model
{
    protected $table = 'jadwal_adzans';

   protected $fillable = [
    'tanggal',
    'dzuhur_imam_id',
    'dzuhur_muadzin_id',
    'ashar_imam_id',
    'ashar_muadzin_id',
    'keterangan',
];

    public function dzuhurImam()
    {
        return $this->belongsTo(Pengurus::class, 'dzuhur_imam_id');
    }

    public function dzuhurMuadzin()
    {
        return $this->belongsTo(Pengurus::class, 'dzuhur_muadzin_id');
    }

    public function asharImam()
    {
        return $this->belongsTo(Pengurus::class, 'ashar_imam_id');
    }

    public function asharMuadzin()
    {
        return $this->belongsTo(Pengurus::class, 'ashar_muadzin_id');
    }
}