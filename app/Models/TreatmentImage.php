<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TreatmentImage extends Model
{
     use HasFactory;

    protected $fillable = [
        'treatmentImageId',
        'treatmentId',
        'image',
        'isPrimary',
    ];

     public function treatment()
    {
        return $this->belongsTo(Treatment::class, 'treatmentId', 'treatmentId');
    }
}
