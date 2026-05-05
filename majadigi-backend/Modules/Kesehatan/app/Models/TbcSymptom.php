<?php

namespace Modules\Kesehatan\Models;

use Illuminate\Database\Eloquent\Model;

class TbcSymptom extends Model
{
    protected $table = 'tbc_symptoms';

    protected $fillable = [
    'screening_id',
    'symptom_id',
    'answer'
];

    public function screenings()
    {
        return $this->belongsToMany(TbcScreening::class, 'tbc_screening_symptoms')
            ->withPivot('is_checked')
            ->withTimestamps();
    }
}