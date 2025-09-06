<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

       protected $fillable = [
        'productId',
        'name',
        'description',
        'quantity',
        'price',
        'product_color',
        'brand_name',
        'category_id',
        'discount',
    ];

protected $casts = [
        'discount' => 'float',
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'productId', 'productId');
    }
}
