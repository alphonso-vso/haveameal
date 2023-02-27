<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Order;
use App\Models\Meal;
use Livewire\WithPagination;

class Orders extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $additionalPrice = Meal::where('id', '=', '2')->first();
        $orders = Order::query()->join('users', 'orders.user_id', '=', 'users.id')
            ->join('meals', 'orders.meal_id', '=', 'meals.id')
            ->select('orders.*', 'users.name as costumer', 'meals.price as price', 'meals.name as meal')
            ->where('users.name', 'like', '%' . $this->search . '%')
            ->orderBy('orders.id', 'DESC')
            ->paginate(10);

        return view('livewire.orders', [
            'orders' => $orders,
            'additionalPrice' => $additionalPrice,
        ]);
    }
}
