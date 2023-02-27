<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Billing;
use App\Models\Meal;
use Livewire\WithPagination;
use Auth;

class Billings extends Component
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
        $billings = Billing::query()->join('users', 'billings.user_id', '=', 'users.id')
            ->join('meals', 'billings.meal_id', '=', 'meals.id')
            ->select('billings.*', 'users.name as costumer', 'meals.price as price', 'meals.name as meal')
            ->where('users.name', 'like', '%' . $this->search . '%')
            ->where('users.id', '=', Auth::user()->id)
            ->orderBy('billings.id', 'DESC')
            ->paginate(10);

        return view('livewire.billings', [
            'billings' => $billings,
            'additionalPrice' => $additionalPrice,
        ]);
    }
}
