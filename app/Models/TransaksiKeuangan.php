<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransaksiKeuangan extends Model
{
    protected $fillable = [
        'kategori_transaksi_id', 'jenis', 'tanggal', 'jumlah', 'sumber_tujuan',
        'keterangan', 'bukti', 'dicatat_oleh', 'kegiatan_id',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'jumlah'  => 'decimal:2',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriTransaksi::class, 'kategori_transaksi_id');
    }

    public function pencatat(): BelongsTo
    {
        return $this->belongsTo(User::class, 'dicatat_oleh');
    }

    public function kegiatan(): BelongsTo
    {
        return $this->belongsTo(Kegiatan::class);
    }

    public function scopePemasukan($query)
    {
        return $query->where('jenis', 'pemasukan');
    }

    public function scopePengeluaran($query)
    {
        return $query->where('jenis', 'pengeluaran');
    }

    public function scopeBulanIni($query)
    {
        return $query->whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year);
    }

    public static function saldoSaatIni(): float
    {
        $pemasukan = static::pemasukan()->sum('jumlah');
        $pengeluaran = static::pengeluaran()->sum('jumlah');

        return (float) $pemasukan - (float) $pengeluaran;
    }
}