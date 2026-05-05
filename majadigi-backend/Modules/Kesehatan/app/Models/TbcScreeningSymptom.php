<?php

namespace Modules\Kesehatan\Models;

use Illuminate\Database\Eloquent\Model;

class TbcScreeningSymptom extends Model
{
    protected $table = 'tbc_screening_symptoms';

    protected $fillable = [
        'screening_id',
        'symptom_id',
        'answer',
        'is_checked'
    ];
}