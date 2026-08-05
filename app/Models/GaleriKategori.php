<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GaleriKategori extends Model
{
    protected $table = 'galeri_kategoris';

    protected $fillable = ['nama_kategori'];

    public function galeris(): HasMany
    {
        return $this->hasMany(Galeri::class);
    }
}