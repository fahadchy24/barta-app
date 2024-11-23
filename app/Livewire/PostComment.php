<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Rule;
use Livewire\Component;

class PostComment extends Component
{
    public Post $post;

    public int $amount = 5;

    #[Rule('required|min:2|max:255')]
    public string $comment = '';

    public function submit(): void
    {
        $this->validateOnly('comment');

        $this->post->comments()->create([
            'comment' => $this->comment,
            'user_id' => auth()->id(),
        ]);

        $this->reset('comment');
    }

    public function loadMore(): void
    {
        $this->amount += 5;
    }

    #[Computed]
    public function comments(): ?LengthAwarePaginator
    {
        return $this?->post?->comments()->latest()->paginate($this->amount);
    }

    public function render(): View
    {
        return view('livewire.post-comment', [
            'comment_count' => $this->post->comments()->count()
        ]);
    }
}
