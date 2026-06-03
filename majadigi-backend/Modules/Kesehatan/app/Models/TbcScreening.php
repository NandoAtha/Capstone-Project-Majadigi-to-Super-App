<?php

namespace Modules\Kesehatan\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TbcScreening extends Model
{
    use HasFactory;

    protected $table = 'tbc_screenings';

    protected $fillable = [
        'user_id',
        'is_self_screening',
        'pelapor_nama',
        'pelapor_kelompok',
        'pelapor_instansi',
        'pelapor_no_telp',
        'pelapor_nik',
        'bantu_lapor_nama',
        'bantu_lapor_nik',
        'nama_pasien',
        'nik_pasien',
        'status_risiko',

        'no_telp',
        'tahun_lahir',
        'bulan_lahir',
        'tanggal_lahir',
        'umur',
        'berat_badan',
        'tinggi_badan',
        'alamat',
        'pekerjaan',
        'kabupaten',
        'kecamatan',
        'kelurahan',
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    // Relasi ke helper
    public function helper()
    {
        return $this->belongsTo(TbcHelper::class, 'helper_id');
    }

    // Relasi ke gejala
    public function symptoms()
    {
        return $this->belongsToMany(TbcSymptom::class, 'tbc_screening_symptoms')
            ->withPivot('is_checked')
            ->withTimestamps();
    }

    // Relasi ke jawaban
    public function answers()
    {
        return $this->hasMany(TbcAnswer::class, 'screening_id');
    }
}