<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class BuscaController extends Controller
{
    public function search(Request $request)
    {
        $q = $request->input('q');

        $posts = Post::where('title', 'like', "%$q%")
                     ->orWhere('abstract', 'like', "%$q%")
                     ->take(5)
                     ->get(['id', 'title']);

        $users = User::where('name', 'like', "%$q%")
                     ->orWhere('email', 'like', "%$q%")
                     ->take(5)
                     ->get(['id', 'name']);

        return response()->json([
            'posts' => $posts,
            'users' => $users
        ]);
    }
}

