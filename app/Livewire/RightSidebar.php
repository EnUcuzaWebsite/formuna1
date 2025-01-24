<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class RightSidebar extends Component
{
    public ?Post $selectedPost = null;

    protected $listeners = [
        "post-selected" => 'showPostDetails'
    ];

    public function showPostDetails(Post $selectedPost)
    {
        $this->selectedPost = $selectedPost;
    }

    public function clearSelectedPost()
    {
        $this->selectedPost = null;
    }



    public function render()
    {
        return view('components.aside.right-sidebar');
    }
}
