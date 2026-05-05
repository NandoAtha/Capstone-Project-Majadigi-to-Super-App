<?php

namespace Modules\Ketenagakerjaan\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TrainingCenter extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'alamat',
        'kota',
        'no_telp',
        'deskripsi',
    ];

    public function trainings()
    {
        return $this->hasMany(Training::class);
    }
}