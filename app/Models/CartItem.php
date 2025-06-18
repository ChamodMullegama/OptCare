<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'product_id',
        'session_id',
        'quantity',
        'price',
        'discount',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function getSubtotalAttribute()
    {
        $discountedPrice = $this->price * (1 - ($this->discount / 100));
        return $discountedPrice * $this->quantity;
    }
}
