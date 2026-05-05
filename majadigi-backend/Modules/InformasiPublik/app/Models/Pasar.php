<?php

namespace Modules\InformasiPublik\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pasar extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pasar',
        'wilayah'
    ];
}