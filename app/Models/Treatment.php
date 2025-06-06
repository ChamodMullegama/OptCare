<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
      use HasFactory;

    protected $fillable = [
        'treatmentId',
        'treatment_name',
        'description',
        'related_eye_diseases',
        'benefits',
    ];

     public function images()
    {
        return $this->hasMany(TreatmentImage::class, 'treatmentId', 'treatmentId');
    }
}
