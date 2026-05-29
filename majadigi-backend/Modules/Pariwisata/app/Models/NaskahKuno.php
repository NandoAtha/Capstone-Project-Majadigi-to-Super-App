<?php

namespace Modules\Pariwisata\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Pariwisata\Database\Factories\NaskahKunoFactory;

class NaskahKuno extends Model
{
    use HasFactory;

    protected $table = 'naskah_kunos';

    protected $fillable = [
        'judul',
        'deskripsi',
        'jumlah_halaman',
        'foto_naskah',
        'kategori',
        'asal_daerah',
        'perkiraan_tahun',
        'jenis_aksara',
        'jenis_bahasa',
        'sumber_naskah',
        'skema_pendaftaran',
        'nama_pendaftar',
        'no_hp_pendaftar',
        'alamat_pendaftar',
        'file_lampiran_pdf',
        'status_pengajuan'
    ];
}