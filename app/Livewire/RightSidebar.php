<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class RightSidebar extends Component
{

    public $selectedPost = null;

    protected $listeners = [
        'post-selected' => 'showPostDetails'
    ];

    public function showPostDetails($event)
    {
        $this->selectedPost = Post::find($event['postId']);
    }

    public function render()
    {
        return view('components.aside.right-sidebar');
    }
}
