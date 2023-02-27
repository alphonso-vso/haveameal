<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Snack;
use App\Models\Meal;
use App\Models\Order;
use App\Models\Billing;
use Carbon\Carbon;
use Auth;

class Snacks extends Component
{
   
    public array $meals;
    public $confirmingMealAdd = false;
    public $snack;
    
    protected $rules = [
        'snack.meal_id' => 'required|numeric',
    ];

    public function mount() {
        $this->meals = Meal::where('meal_time_id', '=', '5')
            ->pluck("name", "id")
            ->toArray();
    }

    public function render()
    {
        $currentDay = Carbon::today()->locale('es')->translatedFormat('m/d/Y');
        $dayName = Carbon::createFromFormat('m/d/Y', $currentDay)->locale('es')->translatedFormat('l');

        $snackss = Snack::query()->join('meals', 'snacks.meal_id', '=', 'meals.id')
            ->select('snacks.*', 'meals.name as meal', 'meals.price as price', 'meals.ingredients as ingredients', 'meals.id as meal_id')
            ->get();

        return view('livewire.snacks', [
            'snackss' => $snackss,
            'dayName' => $dayName,
        ]);
    }

    public function confirmMealAdd()
    {
        $this->reset(['snack']);
        $this->confirmingMealAdd = true;
    }

    public function saveMeal()
    {
        $this->validate();

        $this->snack->save();
        session()->flash('message', 'Comida actualizada con exito');
        
        $this->confirmingMealAdd = false;
    }

    public function confirmMealEdit(Snack $snack)
    {
        $this->snack = $snack;
        $this->confirmingMealAdd = true;
    }

    public $confirmingMealOrder = false;
    public $order;

    public function confirmMealOrder()
    {
        $this->reset(['snack']);
        $this->confirmingMealOrder = true;
    }

    public function orderMeal()
    {
        Order::create([
            'user_id' => Auth::user()->id,
            'meal_id' => $this->snack['meal_id'],
            'quantity' => $this->order['quantity'],
            'additional' => $this->order['additional'],
        ]);
        Billing::create([
            'user_id' => Auth::user()->id,
            'meal_id' => $this->snack['meal_id'],
            'quantity' => $this->order['quantity'],
            'additional' => $this->order['additional'],
        ]);
        session()->flash('message', 'Orden realizada con exito');
        
        $this->confirmingMealOrder = false;
    }

    public function confirmMealOrdering(Snack $snack)
    {
        $this->snack = $snack;
        $this->confirmingMealOrder = true;
    }
}
