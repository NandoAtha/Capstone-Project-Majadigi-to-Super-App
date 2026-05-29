<?php

namespace Modules\Pariwisata\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DestinasiWisata extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'destinasi_wisatas';

    // Kolom yang boleh diisi mass-assignment via API
    protected $fillable = [
        'nama_tempat',
        'deskripsi_sejarah',
        'foto_utama',
        'galeri_foto',
        'harga_tiket_masuk',
        'rating',
        'kabupaten_kota',
        'kecamatan',
        'ketinggian_mdpl',
        'rata_rata_suhu',
        'ikon_cuaca_terkini',
        'is_chse',
        'is_sapta_pesona',
        'sertifikat_kebersihan'
    ];

    // Konversi otomatis kolom bertipe JSON/Boolean saat ditarik ke API
    protected $casts = [
        'galeri_foto' => 'array',
        'is_chse' => 'boolean',
        'is_sapta_pesona' => 'boolean',
        'harga_tiket_masuk' => 'float',
        'rating' => 'float',
        'ketinggian_mdpl' => 'integer',
        'rata_rata_suhu' => 'float',
    ];
}