<?php

namespace Modules\InformasiPublik\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HoaxReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_tiket',
        'nama_pelapor',
        'deskripsi_laporan',
        'url_bukti',
        'status',
    ];
}