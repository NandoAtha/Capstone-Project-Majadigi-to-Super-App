<?php

namespace Modules\Pariwisata\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Pariwisata\Database\Factories\FacilityRoomImageFactory;
use Modules\Pariwisata\Models\FacilityRoom;

class FacilityRoomImage extends Model
{
    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return asset('storage/facilities/rooms/' . $this->image);
    }
}
