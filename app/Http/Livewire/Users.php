<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    public $search = '';
    public $confirmingUserDeletion = false;
    public $confirmingUserAdd = false;
    public $user;

    protected $rules = [
        'user.name' => 'required|string|min:3',
        'user.email' => 'require|string|email',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $users = User::query()
            ->paginate(10);

        return view('livewire.users', [
            'users' => $users,
        ]);
    }
    public function confirmUserDeletion($id)
    {
        $this->confirmingUserDeletion = $id;
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        $this->confirmingUserDeletion = false;
        session()->flash('message', 'Usuario eliminado con exito');
    }

    public function confirmUserAdd()
    {
        $this->reset(['user']);
        $this->confirmingUserAdd = true;
    }

    public function saveUser()
    {
        $this->validate();

        if (isset($this->user->id))
        {
            $this->user->save();
            session()->flash('message', 'Usuario actualizado con exito');
        }
        else
        {
            User::create([
                'name' => $this->meal['name'],
                'email' => $this->meal['email'],
            ]);
            session()->flash('message', 'usuario guardado con exito');
        }

        $this->confirmingUserAdd = false;
    }

    public function confirmUserEdit(User $user)
    {
        $this->user = $user;
        $this->confirmingUserAdd = true;
    }
}
