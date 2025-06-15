<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OctAnalysis extends Model
{
     protected $fillable = [
        'doctor_id',
        'doctor_name',
              'patient_id',
        'patient_name',
        'patient_email',
        'patient_phone',
        'patient_age',
        'eye_side',
        'clinical_notes',
        'image_path',
        'prediction',
        'recommendation',
    ];
}
