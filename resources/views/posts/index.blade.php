@extends('layouts.app')

@section('title', 'Blog')

@push('styles')
<style>
    .blog-layout { display: grid; grid-template-columns: 1fr 300px; gap: 2rem; }
    .post-card { background: #fff; border-radius: .75rem; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,.08); transition: transform .2s; }
    .post-card:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,.1); }
    .post-card h2 { font-size: 1.3rem; margin-bottom: .5rem; }
    .post-card h2 a { color: #16213e; text-decoration: none; }
    .post-card h2 a:hover { color: #e94560; }
    .post-meta { font-size: .85rem; color: #6c757d; margin-bottom: .75rem; }
    .post-meta span { margin-right: 1rem; }
    .post-excerpt { color: #4a4a4a; font-size: .95rem; }
    .badge { display: inline-block; padding: .2rem .6rem; border-radius: 1rem; font-size: .75rem; background: #e94560; color: #fff; }
    .sidebar { position: sticky; top: 2rem; }
    .sidebar-card { background: #fff; border-radius: .75rem; padding: 1.25rem; box-shadow: 0 1px 3px rgba(0,0,0,.08); }
    .sidebar-card h3 { font-size: 1rem; margin-bottom: 1rem; color: #16213e; border-bottom: 2px solid #e94560; padding-bottom: .5rem; }
    .sidebar-card ul { list-style: none; }
    .sidebar-card li { margin-bottom: .5rem; }
    .sidebar-card li a { text-decoration: none; color: #4a4a4a; font-size: .9rem; display: flex; justify-content: space-between; }
    .sidebar-card li a:hover { color: #e94560; }
    .sidebar-card li a span { color: #6c757d; font-size: .8rem; }
    .pagination-wrap { display: flex; justify-content: center; margin-top: 1rem; }
    .pagination-wrap nav { display: flex; gap: .5rem; }
    .empty-state { text-align: center; padding: 3rem; color: #6c757d; }
    @media (max-width: 768px) { .blog-layout { grid-template-columns: 1fr; } }
</style>
@endpush

@section('content')
<div class="blog-layout">
    <div>
        <h1 style="margin-bottom: 1.5rem; font-size: 1.6rem;">Blog Posts</h1>

        @forelse($posts as $post)
            <article class="post-card">
                <h2><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h2>
                <div class="post-meta">
                    <span>By {{ $post->user->name }}</span>
                    <span>{{ $post->published_at->format('M d, Y') }}</span>
                    @if($post->category)
                        <span class="badge">{{ $post->category->name }}</span>
                    @endif
                    <span>{{ $post->comments_count }} {{ Str::plural('comment', $post->comments_count) }}</span>
                </div>
                <p class="post-excerpt">{{ $post->excerpt ?: Str::limit(strip_tags($post->body), 200) }}</p>
            </article>
        @empty
            <div class="empty-state">
                <p>No posts yet. <a href="{{ route('posts.create') }}">Create the first one!</a></p>
            </div>
        @endforelse

        <div class="pagination-wrap">
            {{ $posts->links() }}
        </div>
    </div>

    <aside class="sidebar">
        <div class="sidebar-card">
            <h3>Categories</h3>
            <ul>
                <li><a href="{{ route('posts.index') }}">All <span>({{ $posts->total() }})</span></a></li>
                @foreach($categories as $category)
                    <li>
                        <a href="{{ route('posts.index', ['category' => $category->slug]) }}">
                            {{ $category->name }} <span>({{ $category->posts_count }})</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </aside>
</div>
@endsection
