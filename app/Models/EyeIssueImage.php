<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EyeIssueImage extends Model
{
     use HasFactory;

    protected $fillable = [
        'eyeIssueImageId',
        'eyeIssueId',
        'image',
        'isPrimary',
    ];

    public function eyeIssue()
    {
        return $this->belongsTo(EyeIssue::class, 'eyeIssueId', 'eyeIssueId');
    }
}
