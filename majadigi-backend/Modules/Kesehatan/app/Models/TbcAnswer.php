<?php

namespace Modules\Kesehatan\Models;

use Illuminate\Database\Eloquent\Model;

class TbcAnswer extends Model
{
    protected $table = 'tbc_answers';

    protected $fillable = [
        'screening_id',
        'question_id',
        'answer'
    ];

    public function screening()
    {
        return $this->belongsTo(TbcScreening::class, 'screening_id');
    }

    public function question()
    {
        return $this->belongsTo(TbcQuestion::class, 'question_id');
    }
}