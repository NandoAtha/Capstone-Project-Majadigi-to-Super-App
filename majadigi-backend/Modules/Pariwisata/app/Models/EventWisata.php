<?php

namespace Modules\Pariwisata\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventWisata extends Model
{
    use HasFactory;

    protected $table = 'event_wisatas';

    protected $fillable = [
        'nama_event',
        'deskripsi_acara',
        'poster_event',
        'penyelenggara',
        'tanggal_mulai',
        'tanggal_selesai',
        'jam_operasional',
        'nama_tempat_lokasi',
        'kabupaten_kota',
        'koordinat_maps',
        'is_berbayar',
        'harga_tiket'
    ];

    protected $casts = [
        'tanggal_mulai' => 'date:Y-m-d',
        'tanggal_selesai' => 'date:Y-m-d',
        'is_berbayar' => 'boolean',
        'harga_tiket' => 'float'
    ];

    
}