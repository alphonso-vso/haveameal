<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Meal;
use Livewire\WithPagination;

class Meals extends Component
{
    use WithPagination;

    public $search = '';
    public $confirmingMealDeletion = false;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $meals = Meal::query()->join('meal_times', 'meals.meal_time_id', '=', 'meal_times.id')
            ->select('meals.*', 'meal_times.name as meal_time')
            ->where('meals.name', 'like', '%' . $this->search . '%')
            ->orWhere('meal_times.name', 'like', '%' . $this->search . '%')
            ->paginate(10);

        return view('livewire.meals', [
            'meals' => $meals,
        ]);
    }

    public function confirmMealDeletion($id)
    {
        //$meal->delete();
        $this->confirmingMealDeletion = $id;
    }

    public function deleteMeal(Meal $meal)
    {
        $meal->delete();
        $this->confirmingMealDeletion = false;
    }
}
