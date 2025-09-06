<?php

namespace App\Models;

use Carbon\Carbon;
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
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'doctorId', 'doctorId');
    }

    /**
     * Check if doctor is available at specific date and time
     */
    public function isAvailableAt($date, $time)
    {
        // Check if doctor has any existing appointments at this date and time
        $hasConflictingAppointment = $this->appointments()
            ->where('date', $date)
            ->where('time', $time)
            ->whereIn('status', ['pending', 'accepted', 'completed'])
            ->exists();

        if ($hasConflictingAppointment) {
            return false;
        }

        // Optional: Check doctor's availability schedule if you use this field
        // If availability is null, assume doctor is available at all times
        if (is_null($this->availability)) {
            return true;
        }

        // If availability is set, check if the specific day and time is available
        if (is_array($this->availability)) {
            $dayOfWeek = \Carbon\Carbon::parse($date)->format('l');

            // Check if the day exists in availability and contains the time
            if (isset($this->availability[$dayOfWeek])) {
                return in_array($time, $this->availability[$dayOfWeek]);
            }
        }

        return false;
    }

}
