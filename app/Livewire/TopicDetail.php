<?php

namespace App\Livewire;

use App\Models\Topic;
use Livewire\Component;

class TopicDetail extends Component
{
    public ?Topic $topic;

    public function mount(Topic $topic)
    {
        $this->topic = $topic;
    }

    public function render()
    {
        return view('livewire.topic-detail',[
            'posts' => $this->topic->posts()->paginate(5),
        ]);
    }
}
