<?php

namespace Modules\Ketenagakerjaan\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class JobSeeker extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'nik',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'no_telp',
        'pendidikan_terakhir',
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke lamaran kerja
    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }

    // Relasi ke pelatihan (many-to-many lewat participants)
    public function trainings()
    {
        return $this->belongsToMany(
            Training::class,
            'training_participants',
            'job_seeker_id',
            'training_id'
        )->withPivot('status')->withTimestamps();
    }
}