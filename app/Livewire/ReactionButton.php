<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ReactionButton extends Component
{
    public Post $post;

    public function toggleReaction(): void
    {
        $user = auth()->user();

        if ($user->hasReaction($this->post)) {
            $user->reactions()->detach($this->post);
            return;
        }

        $user->reactions()->attach($this->post);
    }

    public function render(): View
    {
        return view('livewire.reaction-button');
    }
}
