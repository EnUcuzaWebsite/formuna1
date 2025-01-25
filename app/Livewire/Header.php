<?php

namespace App\Livewire;

use App\Models\User;
use Auth;
use Filament\Panel;
use Livewire\Component;

class Header extends Component
{

    public bool $is_admin = false;

    public function mount()
    {
        $user = Auth::user();
        $panel = app(Panel::class);
        $this->is_admin = $user && $user->canAccessPanel($panel);
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }



    public function notification()
    {
        $this->dispatch("notification-selected");
    }

    public function render()
    {
        return view('components.header.header');
    }
}
