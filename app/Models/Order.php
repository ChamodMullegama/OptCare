<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
      use HasFactory;

    protected $fillable = [
        'customer_id',
        'total',
        'status',
        'payment_status',
        'payment_confirmation',
        'first_name',
        'email',
        'phone',
        'country',
        'address',
        'town_city',
        'state',
        'zip',
        'note',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
