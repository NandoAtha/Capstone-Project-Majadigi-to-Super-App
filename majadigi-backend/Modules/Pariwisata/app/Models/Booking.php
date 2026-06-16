<?php

namespace Modules\Pariwisata\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Pariwisata\Database\Factories\BookingFactory;

class Booking extends Model
{
    protected $fillable = [
        'booking_code',
        'facility_room_id',
        'full_name',
        'phone',
        'email',
        'booking_date',
        'session',
        'notes',
        'status'
    ];

    public function room()
    {
        return $this->belongsTo(FacilityRoom::class);
    }

    public function facilities()
    {
        return $this->belongsToMany(
            RoomFacility::class,
            'booking_facilities'
        );
    }
}
