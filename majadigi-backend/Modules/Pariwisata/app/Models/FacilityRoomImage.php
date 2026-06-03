<?php

namespace Modules\Pariwisata\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Pariwisata\Database\Factories\FacilityRoomImageFactory;
use Modules\Pariwisata\Models\FacilityRoom;

class FacilityRoomImage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): FacilityRoomImageFactory
    // {
    //     // return FacilityRoomImageFactory::new();
    // }
}
