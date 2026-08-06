<?php

namespace App\Models\Concerns;

use App\Models\Presensi;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasPresensi
{
    public function presensis(): MorphMany
    {
        return $this->morphMany(Presensi::class, 'presentable');
    }
}