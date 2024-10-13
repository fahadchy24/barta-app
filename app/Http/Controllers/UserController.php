<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        return view('profile.index', [
            'user' => $request->user(),
            'posts' => Post::with('author')->where('author_id', $request->user()->id)->get(),
        ]);
    }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users')->ignore($request->user()->id)],
            'password' => ['nullable', 'string', 'min:8', Password::defaults()],
            'bio' => ['nullable', 'string'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        $user = $request->user();

        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            $avatarPath = $request->file('avatar')->store('user/avatars', 'public');
        }

        $request->user()->update(array_merge($validated, [
            'password' => Hash::make($validated['password']),
            'avatar' => $avatarPath ?? $user->avatar,
        ]));

        return Redirect::route('user.profile.edit')->with('status', 'profile updated');
    }

    public function searchedResult($username): View
    {
        $user = User::query()->where('username', $username)->firstOrFail();

        return view('profile.index', [
            'user' => $user,
            'posts' => Post::with('author')->where('author_id', $user->id)->get(),
        ]);
    }
}
