<?php

namespace App\Livewire;

use App\Models\Post;
use Auth;
use Livewire\Component;

class Home extends Component
{
    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

    public function render()
    {
        $posts = Post::paginate(6);

        return view('livewire.home', compact('posts'));
    }
}
