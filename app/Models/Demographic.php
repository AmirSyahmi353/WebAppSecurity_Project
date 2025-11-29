<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Demographic extends Model
{
    protected $connection = 'mongodb';
    
    protected $collection = 'Demographic';

    // Allow mass assignment for all fields
    protected $fillable = [
        'user_id',
        'full_name',
        'age',
        'gender',
        'race',
        'postcode',
        'occupation',      // instead of work
        'education',       // instead of education_level
        'email',
        'height_cm',
        'weight_kg',
        'income',          // add income if used
    ];
}
