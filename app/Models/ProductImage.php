<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'productImageId',
        'productId',
        'image',
        'isPrimary',
    ];

    protected $casts = [
        'isPrimary' => 'boolean',
    ];
        public function service()
    {
        return $this->belongsTo(Product::class, 'productId', 'productId');
    }
}
