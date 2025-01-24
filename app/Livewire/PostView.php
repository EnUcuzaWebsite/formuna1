<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class PostView extends Component
{
    public Post $post;

    public function detail()
    {
        $this->dispatch("post-selected", $this->post);
    }

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function render()
    {
        return view('livewire.post-view');
    }
}
