<?php

namespace Modules\Pariwisata\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Pariwisata\Database\Factories\FacilityRoomFactory;
use Modules\Pariwisata\Models\Facility;
use Modules\Pariwisata\Models\FacilityRoomImage;
use Modules\Pariwisata\Models\RoomFacility;

class FacilityRoom extends Model
{
    protected $fillable = [
        'facility_id',
        'name',
        'description',
        'thumbnail',
        'capacity',
        'price',
        'status'
    ];

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }

    public function images()
    {
        return $this->hasMany(FacilityRoomImage::class);
    }

    public function facilities()
    {
        return $this->belongsToMany(
            RoomFacility::class,
            'facility_room_facilities'
        );
    }
}
