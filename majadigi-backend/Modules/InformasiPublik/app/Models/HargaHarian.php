<?php

namespace Modules\InformasiPublik\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HargaHarian extends Model
{
    use HasFactory;

    protected $fillable = [
        'bahan_pokok_id',
        'pasar_id',
        'harga_sekarang',
        'tanggal',
        'tren'
    ];

    // Relasi ke tabel Bahan Pokok
    public function bahanPokok()
    {
        return $this->belongsTo(BahanPokok::class);
    }

    // Relasi ke tabel Pasar
    public function pasar()
    {
        return $this->belongsTo(Pasar::class);
    }
}