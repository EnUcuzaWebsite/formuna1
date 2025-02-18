<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class PostView extends Component
{
    public Post $post;
    public bool $is_detail = false;

    public function mount(Post $post, bool $is_detail = false)
    {
        $this->post = $post;
        $this->$is_detail = $is_detail;
    }

    public function render()
    {
        return view('livewire.post-view');
    }
}
