<?php

namespace Modules\Rsud\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Rsud\Database\Factories\RoomCategoryFactory;
use Modules\Rsud\Models\HospitalRoom;

class RoomCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function rooms()
    {
        return $this->hasMany(HospitalRoom::class);
    }
}
