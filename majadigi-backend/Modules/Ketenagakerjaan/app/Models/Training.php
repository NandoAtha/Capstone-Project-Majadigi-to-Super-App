<?php

namespace Modules\Ketenagakerjaan\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Training extends Model
{
    use HasFactory;

    protected $fillable = [
        'training_center_id',
        'nama_pelatihan',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
    ];

    // Relasi ke tempat pelatihan
    public function center()
    {
        return $this->belongsTo(TrainingCenter::class, 'training_center_id');
    }

    // Relasi ke peserta (many-to-many)
    public function participants()
    {
        return $this->belongsToMany(
            JobSeeker::class,
            'training_participants',
            'training_id',
            'job_seeker_id'
        )->withPivot('status')->withTimestamps();
    }
}