<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
     use HasFactory;

    protected $fillable = [
        'doctorId',
        'first_name',
        'last_name',
        'age',
        'gender',
        'email',
        'mobile_number',
        'marital_status',
        'qualification',
        'designation',
        'blood_group',
        'address',
        'country',
        'state',
        'city',
        'postal_code',
        'profile_image',
        'bio',
        'availability',
        'username',
        'password',
    ];

    protected $casts = [
        'availability' => 'array',
    ];

    protected $hidden = [
        'password',
    ];
}
