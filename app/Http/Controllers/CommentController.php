<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $validated = $request->validate([
            'author_name' => 'required|string|max:255',
            'author_email' => 'required|email|max:255',
            'body' => 'required|string|max:2000',
        ]);

        $post->comments()->create($validated);

        return back()->with('success', 'Comment submitted and awaiting approval.');
    }
}
