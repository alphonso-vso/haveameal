<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Other;
use App\Models\Meal;
use App\Models\Order;
use App\Models\Billing;
use Auth;

class Others extends Component
{
   
    public array $meals;
    public $confirmingMealAdd = false;
    public $other;
    
    protected $rules = [
        'other.meal_id' => 'required|numeric',
    ];

    public function mount() {
        $this->meals = Meal::where('meal_time_id', '=', '6')
            ->pluck("name", "id")
            ->toArray();
    }

    public function render()
    {
        $otherss = Other::query()->join('meals', 'others.meal_id', '=', 'meals.id')
            ->select('others.*', 'meals.name as meal', 'meals.price as price', 'meals.ingredients as ingredients', 'meals.id as meal_id')
            ->paginate(10);

        return view('livewire.others', [
            'otherss' => $otherss,
        ]);
    }

    public function confirmMealAdd()
    {
        $this->reset(['other']);
        $this->confirmingMealAdd = true;
    }

    public function saveMeal()
    {
        $this->validate();

        $this->other->save();
        session()->flash('message', 'Comida actualizada con exito');
        
        $this->confirmingMealAdd = false;
    }

    public function confirmMealEdit(Other $other)
    {
        $this->other = $other;
        $this->confirmingMealAdd = true;
    }

    public $confirmingMealOrder = false;
    public $order;

    public function confirmMealOrder()
    {
        $this->reset(['other']);
        $this->confirmingMealOrder = true;
    }

    public function orderMeal()
    {
        Order::create([
            'user_id' => Auth::user()->id,
            'meal_id' => $this->other['meal_id'],
            'quantity' => $this->order['quantity'],
            'additional' => $this->order['additional'],
        ]);
        Billing::create([
            'user_id' => Auth::user()->id,
            'meal_id' => $this->other['meal_id'],
            'quantity' => $this->order['quantity'],
            'additional' => $this->order['additional'],
        ]);
        session()->flash('message', 'Orden realizada con exito');
        
        $this->confirmingMealOrder = false;
    }

    public function confirmMealOrdering(Other $other)
    {
        $this->other = $other;
        $this->confirmingMealOrder = true;
    }
}
