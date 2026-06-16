<?php

namespace Modules\Darurat\Models;

use Illuminate\Database\Eloquent\Model;

class NomorDarurat extends Model
{
    protected $table = 'nomor_darurat';
    protected $fillable = [
        'tingkat_wilayah',
        'nama_wilayah',
        'nama_layanan',
        'nomor_telepon',
        'kategori',
        'keterangan'
    ];
}