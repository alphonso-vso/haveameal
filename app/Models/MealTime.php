<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealTime extends Model
{
    use HasFactory;

    public function meal()
    {
        return $this->belongsTo(\App\Models\Meal::class);
    }
}
