<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EyeHospital extends Model
{
    use HasFactory;

   protected $fillable = [
        'hospitalId',
        'hospital_name',
        'address',
        'location',
        'contact_number',
        'social_media_links',
        'website_link',
        'image',
        'bio',
        'description',
        'clinic_days',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'social_media_links' => 'array',
        'clinic_days' => 'array',
    ];
}
