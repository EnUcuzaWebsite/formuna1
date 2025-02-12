<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class FollowedModal extends Component
{
    public $isShowModal = false;
    public ?User $user;
    public function openModal()
    {
        $this->isShowModal = true;
    }

    public function closeModal()
    {
        $this->isShowModal = false;
    }

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.followed-modal');
    }
}
