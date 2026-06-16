<?php

namespace Modules\Pariwisata\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Pariwisata\Database\Factories\RoomFacilityFactory;
use Modules\Pariwisata\Models\FacilityRoom;
use Modules\Pariwisata\Models\FacilityRoomFacility;

class RoomFacility extends Model
{
    protected $fillable = [
        'name'
    ];
}
