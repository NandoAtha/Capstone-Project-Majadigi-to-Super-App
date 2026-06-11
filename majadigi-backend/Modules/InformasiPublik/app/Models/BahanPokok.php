<?php

namespace Modules\InformasiPublik\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BahanPokok extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_bahan',
        'satuan',
        'foto',
        'harga_tertinggi',
        'harga_terendah'
    ];
}