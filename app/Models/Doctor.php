<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Doctor extends Authenticatable
{
    use HasFactory, Notifiable;

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
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // In Doctor.php model
// public function appointments()
// {
//     return $this->hasMany(Appointment::class, 'doctorId', 'doctorId');
// }



}
