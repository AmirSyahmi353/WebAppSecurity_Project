<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Questionnaire extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'questionnaires';
}

