<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
     use HasFactory;

    protected $table = 'appointments';

    protected $fillable = [
        'appointmentId',
        'doctorId',
        'user_id',
        'name',
        'email',
        'phone',
        'date',
        'time',
        'message',
         'status',
        'meeting_link',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctorId', 'doctorId');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
