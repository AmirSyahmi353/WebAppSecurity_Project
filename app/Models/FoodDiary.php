<?php
namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class FoodDiary extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'food_diaries';

    protected $fillable = ['user_id', 'entries', 'submitted_at'];
    // protected $fillable = ['user_id','day','date','time','meal_type','drink','food_items'];

    // protected $casts = [
    //     'food_items' => 'array',
    // ];
}
