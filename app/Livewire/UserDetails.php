<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class UserDetails extends Component
{
    public $user;

    public function mount($user)
    {
        $this->user = User::findOrFail($user);
    }

    public function render()
    {
        return view('livewire.user-details');
    }
}
