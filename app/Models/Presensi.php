<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Presensi extends Model
{
    protected $table = 'presensis';

    protected $fillable = [
        'presentable_id', 'presentable_type', 'pengurus_id', 'tanggal',
        'status', 'waktu_presensi', 'metode', 'pengganti_id', 'keterangan',
        'dicatat_oleh',
    ];

    protected $casts = [
        'tanggal'        => 'date',
        'waktu_presensi' => 'datetime:H:i',
    ];

    public const STATUS_HADIR       = 'hadir';
    public const STATUS_TIDAK_HADIR = 'tidak_hadir';
    public const STATUS_IZIN        = 'izin';
    public const STATUS_SAKIT       = 'sakit';
    public const STATUS_DIGANTI     = 'diganti';

    public const METODE_MANUAL = 'manual';
    public const METODE_QR     = 'qr';
    public const METODE_SELF   = 'self';

    public function presentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function pengurus(): BelongsTo
    {
        return $this->belongsTo(Pengurus::class);
    }

    public function pengganti(): BelongsTo
    {
        return $this->belongsTo(Pengurus::class, 'pengganti_id');
    }

    public function pencatat(): BelongsTo
    {
        return $this->belongsTo(User::class, 'dicatat_oleh');
    }

    public function scopeHadir($query)
    {
        return $query->where('status', self::STATUS_HADIR);
    }

    public function scopeStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    public function scopeTanggal($query, $tanggal)
    {
        return $query->whereDate('tanggal', $tanggal);
    }

    public function scopeRentang($query, $dari, $sampai)
    {
        return $query->whereBetween('tanggal', [$dari, $sampai]);
    }

    public function scopeBulanIni($query)
    {
        return $query->whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year);
    }

    public function scopeJenis($query, string $class)
    {
        return $query->where('presentable_type', $class);
    }

    public function scopeUntukPengurus($query, int $pengurusId)
    {
        return $query->where('pengurus_id', $pengurusId);
    }

    public function getLabelStatusAttribute(): string
    {
        return match ($this->status) {
            self::STATUS_HADIR       => 'Hadir',
            self::STATUS_TIDAK_HADIR => 'Tidak Hadir',
            self::STATUS_IZIN        => 'Izin',
            self::STATUS_SAKIT       => 'Sakit',
            self::STATUS_DIGANTI     => 'Diganti',
            default                  => ucfirst($this->status),
        };
    }
}