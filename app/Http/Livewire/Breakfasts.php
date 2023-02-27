<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Breakfast;
use App\Models\Meal;
use App\Models\Order;
use App\Models\Billing;
use Carbon\Carbon;
use Auth;

class Breakfasts extends Component
{
   
    public array $meals;
    public $confirmingMealAdd = false;
    public $breakfast;
    
    protected $rules = [
        'breakfast.meal_id' => 'required|numeric',
    ];

    public function mount() {
        $this->meals = Meal::where('meal_time_id', '=', '3')
            ->pluck("name", "id")
            ->toArray();
    }

    public function render()
    {
        $currentDay = Carbon::today()->locale('es')->translatedFormat('m/d/Y');
        $dayName = Carbon::createFromFormat('m/d/Y', $currentDay)->locale('es')->translatedFormat('l');

        $breakfastss = Breakfast::query()->join('meals', 'breakfasts.meal_id', '=', 'meals.id')
            ->select('breakfasts.*', 'meals.name as meal', 'meals.price as price', 'meals.ingredients as ingredients', 'meals.id as meal_id')
            ->get();

            
        return view('livewire.breakfasts', [
            'breakfastss' => $breakfastss,
            'dayName' => $dayName,
        ]);
    }

    public function confirmMealAdd()
    {
        $this->reset(['breakfast']);
        $this->confirmingMealAdd = true;
    }

    public function saveMeal()
    {
        $this->validate();

        $this->breakfast->save();
        session()->flash('message', 'Comida actualizada con exito');
        
        $this->confirmingMealAdd = false;
    }

    public function confirmMealEdit(Breakfast $breakfast)
    {
        $this->breakfast = $breakfast;
        $this->confirmingMealAdd = true;
    }

    public $confirmingMealOrder = false;
    public $order;

    public function confirmMealOrder()
    {
        $this->reset(['breakfast']);
        $this->confirmingMealOrder = true;
    }

    public function orderMeal()
    {
        Order::create([
            'user_id' => Auth::user()->id,
            'meal_id' => $this->breakfast['meal_id'],
            'quantity' => $this->order['quantity'],
            'additional' => $this->order['additional'],
        ]);
        Billing::create([
            'user_id' => Auth::user()->id,
            'meal_id' => $this->breakfast['meal_id'],
            'quantity' => $this->order['quantity'],
            'additional' => $this->order['additional'],
        ]);
        session()->flash('message', 'Orden realizada con exito');
        
        $this->confirmingMealOrder = false;
    }

    public function confirmMealOrdering(Breakfast $breakfast)
    {
        $this->breakfast = $breakfast;
        $this->confirmingMealOrder = true;
    }
}
