<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'serviceId',
        'title',
        'description',
        'image',
    ];

        public function images()
{
    return $this->hasMany(ServiceImage::class, 'serviceId', 'serviceId');
}
}
