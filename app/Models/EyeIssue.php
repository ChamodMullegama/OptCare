<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EyeIssue extends Model
{
    use HasFactory;

    protected $fillable = [
        'eyeIssueId',
        'name',
        'description',
        'symptoms',
        'causes',
        'treatments',
    ];

    public function images()
    {
        return $this->hasMany(EyeIssueImage::class, 'eyeIssueId', 'eyeIssueId');
    }
}
