<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::published()
            ->with(['user', 'category'])
            ->withCount('comments')
            ->when($request->category, fn ($q, $slug) => $q->whereHas('category', fn ($q) => $q->where('slug', $slug)))
            ->latest('published_at')
            ->paginate(10);

        $categories = Category::withCount('posts')->get();

        return view('posts.index', compact('posts', 'categories'));
    }

    public function show(Post $post)
    {
        $post->load(['user', 'category', 'comments' => fn ($q) => $q->where('is_approved', true)->latest()]);

        return view('posts.show', compact('post'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'excerpt' => 'nullable|string|max:500',
            'body' => 'required|string',
            'status' => 'in:draft,published',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['user_id'] = 1; // placeholder
        if ($validated['status'] === 'published') {
            $validated['published_at'] = now();
        }

        $post = Post::create($validated);

        return redirect()->route('posts.show', $post)->with('success', 'Post created successfully.');
    }
}
