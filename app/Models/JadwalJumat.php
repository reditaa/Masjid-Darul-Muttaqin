<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalJumat extends Model
{

    protected $table = 'jadwal_jumats';


    protected $fillable = [

        'pasaran',

        'khatib_id',

        'imam_id',

    ];



    public function khatib()
    {

        return $this->belongsTo(
            Pengurus::class,
            'khatib_id'
        );

    }



    public function imam()
    {

        return $this->belongsTo(
            Pengurus::class,
            'imam_id'
        );

    }

}