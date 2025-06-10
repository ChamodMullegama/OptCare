<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpticCenter extends Model
{
    use HasFactory;
protected $fillable = [
        'hospitalId',
        'hospital_name',
        'address',
        'location',
        'latitude',
        'longitude',
        'contact_number',
        'email',
        'social_media_links',
        'website_link',
        'image',
        'bio',
        'description',
        'clinic_days',
        'open_days',
        'open_time',
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
        'social_media_links' => 'array',
        'clinic_days' => 'array',
        'open_time' => 'datetime',
    ];
}
