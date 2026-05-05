<?php

namespace Modules\Kesehatan\Models;

use Illuminate\Database\Eloquent\Model;

class TbcQuestion extends Model
{
    protected $table = 'tbc_questions';

    protected $fillable = [
        'question'
    ];

    public function answers()
    {
        return $this->hasMany(TbcAnswer::class, 'question_id');
    }
}