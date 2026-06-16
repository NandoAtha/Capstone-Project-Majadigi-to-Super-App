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
        return $this->image 
            ? env('SUPABASE_URL') . '/storage/v1/object/public/' . env('SUPABASE_BUCKET') . '/' . $this->image
            : null;
    }
}
