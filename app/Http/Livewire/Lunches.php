<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Lunch;
use App\Models\Meal;
use App\Models\Order;
use App\Models\Billing;
use Carbon\Carbon;
use Auth;

class Lunches extends Component
{
   
    public array $meals;
    public $confirmingMealAdd = false;
    public $lunch;
    
    protected $rules = [
        'lunch.meal_id' => 'required|numeric',
    ];

    public function mount() {
        $this->meals = Meal::where('meal_time_id', '=', '4')
            ->pluck("name", "id")
            ->toArray();
    }

    public function render()
    {
        $currentDay = Carbon::today()->locale('es')->translatedFormat('m/d/Y');
        $dayName = Carbon::createFromFormat('m/d/Y', $currentDay)->locale('es')->translatedFormat('l');

        $lunchess = Lunch::query()->join('meals', 'lunches.meal_id', '=', 'meals.id')
            ->select('lunches.*', 'meals.name as meal', 'meals.price as price', 'meals.ingredients as ingredients', 'meals.id as meal_id')
            ->get();

        return view('livewire.lunches', [
            'lunchess' => $lunchess,
            'dayName' => $dayName,
        ]);
    }

    public function confirmMealAdd()
    {
        $this->reset(['lunch']);
        $this->confirmingMealAdd = true;
    }

    public function saveMeal()
    {
        $this->validate();

        $this->lunch->save();
        session()->flash('message', 'Comida actualizada con exito');
        
        $this->confirmingMealAdd = false;
    }

    public function confirmMealEdit(Lunch $lunch)
    {
        $this->lunch = $lunch;
        $this->confirmingMealAdd = true;
    }

    public $confirmingMealOrder = false;
    public $order;

    public function confirmMealOrder()
    {
        $this->reset(['lunch']);
        $this->confirmingMealOrder = true;
    }

    public function orderMeal()
    {
        Order::create([
            'user_id' => Auth::user()->id,
            'meal_id' => $this->lunch['meal_id'],
            'quantity' => $this->order['quantity'],
            'additional' => $this->order['additional'],
        ]);
        Billing::create([
            'user_id' => Auth::user()->id,
            'meal_id' => $this->lunch['meal_id'],
            'quantity' => $this->order['quantity'],
            'additional' => $this->order['additional'],
        ]);
        session()->flash('message', 'Orden realizada con exito');
        
        $this->confirmingMealOrder = false;
    }

    public function confirmMealOrdering(Lunch $lunch)
    {
        $this->lunch = $lunch;
        $this->confirmingMealOrder = true;
    }
}
