<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EyeScanImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'eyeScanImageId',
        'eyeScanId',
        'image',
        'isPrimary',
    ];

    public function eyeScan()
    {
        return $this->belongsTo(EyeScan::class, 'eyeScanId', 'eyeScanId');
    }
}
