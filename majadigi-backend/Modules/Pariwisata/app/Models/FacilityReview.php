<?php

namespace Modules\Pariwisata\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Pariwisata\Database\Factories\FacilityReviewFactory;
use Modules\Pariwisata\Models\Facility;

class FacilityReview extends Model
{
    protected $fillable = [
        'facility_id',
        'full_name',
        'rating',
        'review',
        'status'
    ];

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }
}
