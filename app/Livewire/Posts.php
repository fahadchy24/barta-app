<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Posts extends Component
{
    public int $amount = 10;

    public function loadMore(): void
    {
        $this->amount += 10;
    }

    public function render(): View
    {
        $posts = Post::latest()->paginate($this->amount);
        return view('livewire.posts', compact('posts'));
    }
}
