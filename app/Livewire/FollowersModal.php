<?php

namespace App\Livewire;

use Livewire\Component;

class FollowersModal extends Component
{
    public $isShowModal = false;
    public $user;
    public function openModal()
    {
        $this->isShowModal = true;
    }

    public function closeModal()
    {
        $this->isShowModal = false;
    }

    public function mount($user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.followers-modal');
    }
}
