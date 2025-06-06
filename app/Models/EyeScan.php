<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EyeScan extends Model
{
      use HasFactory;

    protected $fillable = [
        'eyeScanId',
        'name',
        'description',
        'purpose',
        'usage',
    ];

    public function images()
    {
        return $this->hasMany(EyeScanImage::class, 'eyeScanId', 'eyeScanId');
    }
}
