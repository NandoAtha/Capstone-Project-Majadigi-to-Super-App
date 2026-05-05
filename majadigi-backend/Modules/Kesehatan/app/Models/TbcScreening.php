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
        'pelapor_nama',
        'pelapor_kelompok',
        'pelapor_instansi',
        'pelapor_no_telp',
        'status_risiko'
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