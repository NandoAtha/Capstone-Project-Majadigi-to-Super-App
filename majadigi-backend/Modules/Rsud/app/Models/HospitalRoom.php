<?php

namespace Modules\Rsud\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Rsud\Database\Factories\RoomFactory;
use Modules\Rsud\Models\RoomCategory;

class HospitalRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_category_id',
        'name',
        'class_name',
        'total_beds',
        'occupied_beds',
    ];

    public function category()
    {
        return $this->belongsTo(RoomCategory::class);
    }
}
