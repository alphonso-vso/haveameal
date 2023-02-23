<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'ingredients', 'meal_time_id', 'price'];

    public function mealTime()
    {
        return $this->hasOne(\App\Models\MealTime::class);
    }
}
