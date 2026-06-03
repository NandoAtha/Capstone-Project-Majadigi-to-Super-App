<?php

namespace Modules\Pariwisata\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Pariwisata\Database\Factories\FacilityFactory;
use Modules\Pariwisata\Models\FacilityRoom;
use Modules\Pariwisata\Models\FacilityReview;

class Facility extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'thumbnail',
        'status'
    ];

    public function rooms()
    {
        return $this->hasMany(FacilityRoom::class);
    }

    public function reviews()
    {
        return $this->hasMany(FacilityReview::class);
    }
    
}
