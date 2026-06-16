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
        'kategori',          // ini untuk filter Layar 2 FE
        'foto',
        'harga_tertinggi',
        'daerah_tertinggi',  //  ini untuk info detail Layar 3 FE
        'harga_terendah',
        'daerah_terendah'    //  ini untuk info detail Layar 3 FE
    ];
}