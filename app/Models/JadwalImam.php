<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalImam extends Model
{
    protected $table = 'jadwal_imams';


    protected $fillable = [
        'hari',
        'waktu_sholat',
        'imam_1',
        'imam_2',
        'imam_3',
    ];


    // Imam pertama
    public function imam1()
    {
        return $this->belongsTo(Pengurus::class, 'imam_1');
    }


    // Imam kedua
    public function imam2()
    {
        return $this->belongsTo(Pengurus::class, 'imam_2');
    }


    // Imam ketiga
    public function imam3()
    {
        return $this->belongsTo(Pengurus::class, 'imam_3');
    }
}