<?php

namespace Modules\Pariwisata\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Pariwisata\Database\Factories\FacilityRoomFacilityFactory;
use Modules\Pariwisata\Models\FacilityRoom;
use Modules\Pariwisata\Models\RoomFacility;

class FacilityRoomFacility extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): FacilityRoomFacilityFactory
    // {
    //     // return FacilityRoomFacilityFactory::new();
    // }
}
