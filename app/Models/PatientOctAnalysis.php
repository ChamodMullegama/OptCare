<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientOctAnalysis extends Model
{
    use HasFactory;

    protected $table = 'patient_oct_analyses';

    protected $fillable = [
        'user_id',
        'image_path',
        'prediction',
        'recommendation',
        'need_help',
        'reply_message',
        'customer_email',
         'replied_by_doctor_id',
        'replied_by_doctor_name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
