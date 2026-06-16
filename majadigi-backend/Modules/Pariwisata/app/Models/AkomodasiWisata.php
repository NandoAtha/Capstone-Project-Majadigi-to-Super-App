<?php

namespace Modules\Pariwisata\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AkomodasiWisata extends Model
{
    use HasFactory;

    protected $table = 'akomodasi_wisatas';

    protected $fillable = [
        'nama_akomodasi',
        'foto_utama',
        'kabupaten_kota',
        'harga_sewa_terendah',
        'deskripsi_fasilitas_utama',
        'galeri_foto',
        'fasilitas_populer',
        'rating_total',
        'ulasan_tamu'
    ];

    // Konversi otomatis kolom JSON agar menjadi Array di API
    protected $casts = [
        'galeri_foto' => 'array',
        'fasilitas_populer' => 'array',
        'ulasan_tamu' => 'array',
        'harga_sewa_terendah' => 'float',
        'rating_total' => 'float',
    ];
}