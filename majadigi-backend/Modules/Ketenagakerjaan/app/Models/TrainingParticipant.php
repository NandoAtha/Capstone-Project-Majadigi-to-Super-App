<?php

namespace Modules\Ketenagakerjaan\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TrainingParticipant extends Model
{
    use HasFactory;

    protected $table = 'training_participants';

    protected $fillable = [
        'job_seeker_id',
        'training_id',
        'status',
    ];

    public function jobSeeker()
    {
        return $this->belongsTo(JobSeeker::class);
    }

    public function training()
    {
        return $this->belongsTo(Training::class);
    }
}