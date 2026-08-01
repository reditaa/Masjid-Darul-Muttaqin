<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalImam extends Model
{

    protected $table = 'jadwal_imams';


    protected $fillable = [

        'hari',

        'dzuhur_imam_1',
        'dzuhur_imam_2',
        'dzuhur_imam_3',

        'ashar_imam_1',
        'ashar_imam_2',
        'ashar_imam_3',

    ];



    // DZUHUR

    public function dzuhurImam1()
    {
        return $this->belongsTo(
            Pengurus::class,
            'dzuhur_imam_1'
        );
    }


    public function dzuhurImam2()
    {
        return $this->belongsTo(
            Pengurus::class,
            'dzuhur_imam_2'
        );
    }


    public function dzuhurImam3()
    {
        return $this->belongsTo(
            Pengurus::class,
            'dzuhur_imam_3'
        );
    }



    // ASHAR

    public function asharImam1()
    {
        return $this->belongsTo(
            Pengurus::class,
            'ashar_imam_1'
        );
    }


    public function asharImam2()
    {
        return $this->belongsTo(
            Pengurus::class,
            'ashar_imam_2'
        );
    }


    public function asharImam3()
    {
        return $this->belongsTo(
            Pengurus::class,
            'ashar_imam_3'
        );
    }


}