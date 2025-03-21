<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function index()
    {
        $posts = Post::with('comments')->get();
        return view('post.index', ['posts' => $posts]);;
    }

    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required'
        ]);

        $post->comments()->create([
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);


        return redirect()->route('posts.index');
    }
}
