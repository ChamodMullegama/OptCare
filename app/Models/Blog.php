<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'blogId',
        'title',
        'date',
        'content',
        'tags',
        'special_thing',
    ];

    public function images()
    {
        return $this->hasMany(BlogImage::class, 'blogId', 'blogId');
    }
}
