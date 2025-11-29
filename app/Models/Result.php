<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model; // ✅ use official MongoDB driver

class Result extends Model
{
    protected $connection = 'mongodb';  // ✅ same as FoodDiary
    protected $collection = 'results';  // your own collection

    protected $fillable = [
        'user_id',
        'totalScore',
        'maxScore',
        'level',
        'answers'
    ];

    protected $casts = [
        'answers' => 'array', // ✅ so answers is stored properly
    ];
}
