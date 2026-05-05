<?php

namespace Modules\Kesehatan\Models;

use Illuminate\Database\Eloquent\Model;

class TbcHelper extends Model
{
    protected $table = 'tbc_helpers';

    protected $fillable = [
        'name',
        'group',
        'instansi',
        'phone'
    ];

    public function screenings()
    {
        return $this->hasMany(TbcScreening::class, 'helper_id');
    }
}