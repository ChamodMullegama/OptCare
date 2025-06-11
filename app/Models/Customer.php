<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
       use HasFactory;
   protected $table = 'customers';
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'gender',
        'birth_date',
        'age',
        'password',
        'otp',
        'otp_expires_at',
        'verified_account',
    ];

    protected $hidden = [
        'password',
        'otp',
        'otp_expires_at',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'otp_expires_at' => 'datetime',
        'verified_account' => 'boolean',
    ];
}
