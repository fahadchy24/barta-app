<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(): View
    {
        $posts = Post::latest()->get();

        return view('home', compact('posts'));
    }

    public function userSearch(Request $request): JsonResponse
    {
        $query = $request->get('query');

        if ($query) {
            $users = User::where('username', 'LIKE', '%' . $query . '%')
                ->orWhere('first_name', 'LIKE', '%' . $query . '%')
                ->orWhere('last_name', 'LIKE', '%' . $query . '%')
                ->orWhere('email', 'LIKE', '%' . $query . '%')
                ->get(['id', 'first_name', 'last_name', 'username', 'email']);

            return response()->json($users);
        }

        return response()->json([]);
    }
}
