<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class PostList extends Component
{
    use WithPagination;

    public int $amount = 10;

    public function loadMore(): void
    {
        $this->amount += 10;
    }

    public function render(): View
    {
        return view('livewire.post-list', [
            'posts' => Post::latest()->paginate($this->amount),
        ]);
    }
}
