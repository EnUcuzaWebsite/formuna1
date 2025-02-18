<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $posts = Post::where('status', 'active')->orderBy('created_at', 'desc')->paginate(6);

        return view('livewire.home', compact('posts'));
    }
}
