<?php

namespace Modules\Pariwisata\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Pariwisata\Database\Factories\BookingFacilityFactory;

class BookingFacility extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'booking_id',
        'room_facility_id',
    ];
}
