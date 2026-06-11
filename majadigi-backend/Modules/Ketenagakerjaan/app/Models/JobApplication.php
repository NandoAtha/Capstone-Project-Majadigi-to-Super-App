<?php

namespace Modules\Ketenagakerjaan\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_seeker_id',
        'job_training_id',
        'status',
        'tanggal_daftar',
        'tanggal_pengumuman',
        'keterangan',
    ];

    // Relasi ke pelamar
    public function jobSeeker()
    {
        return $this->belongsTo(JobSeeker::class);
    }

    // Relasi ke job
    public function jobTraining()
    {
        return $this->belongsTo(JobTraining::class);
    }
}