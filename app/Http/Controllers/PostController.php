<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        Post::create([
            'author_id' => auth()->id(),
            'message' => $request->message
        ]);

        return redirect()->back();
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        $validatedData = $request->validate([
            'message' => 'required|string',
        ]);

        if (Auth::id() !== $post->author_id) {
            return redirect()->back()->withErrors('You are not authorized to edit this post.');
        }

        $post->update($validatedData);

        return redirect()->route('home')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post): RedirectResponse
    {
        if (Auth::id() !== $post->author_id) {
            return redirect()->back()->withErrors('You are not authorized to delete this post.');
        }

        $post->delete();

        return redirect()->route('home')->with('success', 'Post deleted successfully.');
    }
}
