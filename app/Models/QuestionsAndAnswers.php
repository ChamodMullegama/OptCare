<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionsAndAnswers extends Model
{
    use HasFactory;

    protected $fillable = [
        'qaId',
        'question',
        'answer',
    ];
}
