<?php

namespace Modules\Ketenagakerjaan\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobTraining extends Model
{
    use HasFactory;

    protected $table = 'jobs_training';
    
    protected $fillable = [
        'posisi',
        'perusahaan',
        'lokasi',
        'deskripsi',
        'kualifikasi',
        'tanggal_buka',
        'tanggal_tutup',
    ];

    // Relasi ke lamaran
    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }
}