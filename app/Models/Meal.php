<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;

    public function mealTime()
    {
        return $this->hasMany(\App\Models\MealTime::class);
    }
}
