<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerMessage extends Model
{
      use HasFactory;

    protected $fillable = [
        'messageId',
        'name',
        'email',
        'phone',
        'subject',
        'message',
             'reply_message',
        'replied_at',
    ];
}
