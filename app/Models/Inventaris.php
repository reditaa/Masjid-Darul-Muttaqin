<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    protected $table = 'inventaris';

    protected $fillable = [
        'kode_inventaris', 'nama_barang', 'kategori', 'jumlah', 'satuan',
        'kondisi', 'lokasi_penyimpanan', 'tanggal_perolehan', 'sumber_perolehan',
        'harga_perolehan', 'foto', 'keterangan',
    ];

    protected $casts = [
        'tanggal_perolehan' => 'date',
        'harga_perolehan'   => 'decimal:2',
    ];

    public function scopeKondisiBaik($query)
    {
        return $query->where('kondisi', 'baik');
    }

    public function scopeKategori($query, string $kategori)
    {
        return $query->where('kategori', $kategori);
    }
}