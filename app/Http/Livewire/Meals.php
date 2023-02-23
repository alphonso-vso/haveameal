<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Meal;

class Meals extends Component
{
    public function render()
    {
        $meals = Meal::query()->join('meal_times', 'meals.meal_time_id', '=', 'meal_times.id')
            ->select('meals.*', 'meal_times.name as meal_time')
            ->paginate(10);

        return view('livewire.meals', [
            'meals' => $meals,
        ]);
    }
}
