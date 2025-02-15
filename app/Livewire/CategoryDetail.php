<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategoryDetail extends Component
{
    public ?Category $category;

    public function mount(Category $category)
    {
        $this->category = $category;
    }

    public function render()
    {
        return view('livewire.category-detail', [
            'posts' => $this->category->posts()->paginate(5),
        ]);
    }
}
