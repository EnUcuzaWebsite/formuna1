<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class RightSidebar extends Component
{
    public ?Post $selectedPost = null;
    public ?bool $showNotifications = false;

    protected $listeners = [
        "post-selected" => 'showPostDetails',
        "notification-selected" => 'notificationSelected',
    ];

    public function showPostDetails(Post $selectedPost)
    {
        $this->selectedPost = $selectedPost;
    }

    public function notificationSelected()
    {
        $this->selectedPost = null;
        $this->showNotifications = true;
    }

    public function clearSelected()
    {
        $this->selectedPost = null;
        $this->showNotifications = false;
    }



    public function render()
    {
        return view('components.aside.right-sidebar');
    }
}
