<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'message' => 'required_without:picture',
            'picture' => 'required_without:message|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $post = new Post;
        $post->author_id = auth()->id();
        $post->message = $request->message;

        if ($request->hasFile('picture')) {
            $postImagePath = $request->file('picture')->store('post/images', 'public');
            $post->picture = $postImagePath;
        }

        $post->save();

        return redirect()->back();
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        $validatedData = $request->validate([
            'message' => 'required_without:picture|string',
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

        if ($post->picture) {
            Storage::disk('public')->delete($post->picture);
        }

        $post->delete();

        return redirect()->route('home')->with('success', 'Post deleted successfully.');
    }
}
