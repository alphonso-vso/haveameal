<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Meal;
use App\Models\MealTime;
use Livewire\WithPagination;

class Meals extends Component
{
    use WithPagination;

    public $search = '';
    public $confirmingMealDeletion = false;
    public $confirmingMealAdd = false;
    public array $meal_times;
    public $meal;

    protected $rules = [
        'meal.name' => 'required|string|min:3',
        'meal.ingredients' => 'string',
        'meal.meal_time_id' => 'required|numeric',
        'meal.price' => 'required|numeric'
    ];

    public function mount() {
        $this->meal_times = MealTime::pluck("name", "id")->toArray();
    }

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
        $this->confirmingMealDeletion = $id;
    }

    public function deleteMeal(Meal $meal)
    {
        $meal->delete();
        $this->confirmingMealDeletion = false;
        session()->flash('message', 'Comida eliminada con exito');
    }

    public function confirmMealAdd()
    {
        $this->reset(['meal']);
        $this->confirmingMealAdd = true;
    }

    public function saveMeal()
    {
        $this->validate();

        if (isset($this->meal->id))
        {
            $this->meal->save();
            session()->flash('message', 'Comida actualizada con exito');
        }
        else
        {
            Meal::create([
                'name' => $this->meal['name'],
                'ingredients' => $this->meal['ingredients'],
                'meal_time_id' => $this->meal['meal_time_id'],
                'price' => $this->meal['price'],
            ]);
            session()->flash('message', 'Comida guardada con exito');
        }

        $this->confirmingMealAdd = false;
    }

    public function confirmMealEdit(Meal $meal)
    {
        $this->meal = $meal;
        $this->confirmingMealAdd = true;
    }
}
