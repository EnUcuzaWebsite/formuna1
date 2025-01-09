<?php

namespace App\Livewire;

use Livewire\Component;

class Home extends Component
{
    public $users =[
        "zafer",
        "lider",
        "kutay",
    ];

    public function render()
    {
        return view('livewire.home');
    }
}
