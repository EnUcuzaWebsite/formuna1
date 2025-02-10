<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class PostView extends Component
{
    public Post $post;
    public bool $nofollow = false;

    public function mount(Post $post, bool $nofollow = false)
    {
        $this->post = $post;
        $this->nofollow = $nofollow;
    }

    public function render()
    {
        return view('livewire.post-view');
    }
}
