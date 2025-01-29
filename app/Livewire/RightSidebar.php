<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Post;
use App\Models\Topic;
use Livewire\Component;

class RightSidebar extends Component
{
    public ?bool $showNotifications = false;

    public $categories;
    public $topics;

    protected $listeners = [
        'notification-selected' => 'notificationSelected',
    ];


    public function notificationSelected()
    {
        $this->showNotifications = true;
    }

    public function clearSelected()
    {
        $this->showNotifications = false;
    }

    public function render()
    {
        $this->categories = Post::mostSharedCategory(count: 3);
        $this->topics = Post::mostSharedTopic(count: 5);

        return view('components.aside.right-sidebar');
    }
}
