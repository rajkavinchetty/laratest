@extends('layouts.app')

@section('title', $post->title)

@push('styles')
<style>
    .post-header { margin-bottom: 2rem; }
    .post-header h1 { font-size: 2rem; margin-bottom: .5rem; color: #16213e; }
    .post-header .meta { font-size: .9rem; color: #6c757d; }
    .post-header .meta span { margin-right: 1rem; }
    .post-body { background: #fff; border-radius: .75rem; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,.08); margin-bottom: 2rem; line-height: 1.8; font-size: 1.05rem; }
    .comments-section { margin-top: 2rem; }
    .comments-section h2 { font-size: 1.3rem; margin-bottom: 1rem; }
    .comment { background: #fff; border-radius: .5rem; padding: 1rem 1.25rem; margin-bottom: 1rem; box-shadow: 0 1px 2px rgba(0,0,0,.05); }
    .comment .comment-meta { font-size: .85rem; color: #6c757d; margin-bottom: .5rem; }
    .comment .comment-meta strong { color: #16213e; }
    .comment-form { background: #fff; border-radius: .75rem; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,.08); margin-top: 1.5rem; }
    .comment-form h3 { margin-bottom: 1rem; font-size: 1.1rem; }
    .form-group { margin-bottom: 1rem; }
    .form-group label { display: block; margin-bottom: .3rem; font-weight: 600; font-size: .9rem; color: #333; }
    .form-group input, .form-group textarea { width: 100%; padding: .6rem .8rem; border: 1px solid #ddd; border-radius: .4rem; font-size: .95rem; font-family: inherit; }
    .form-group textarea { resize: vertical; min-height: 100px; }
    .form-group input:focus, .form-group textarea:focus { outline: none; border-color: #e94560; box-shadow: 0 0 0 3px rgba(233,69,96,.1); }
    .btn { display: inline-block; padding: .6rem 1.5rem; background: #e94560; color: #fff; border: none; border-radius: .4rem; font-size: .95rem; cursor: pointer; text-decoration: none; }
    .btn:hover { background: #c73652; }
    .btn-outline { background: transparent; color: #16213e; border: 1px solid #dee2e6; }
    .btn-outline:hover { background: #f8f9fa; }
    .error { color: #dc3545; font-size: .85rem; margin-top: .25rem; }
    .back-link { display: inline-block; margin-bottom: 1.5rem; color: #6c757d; text-decoration: none; font-size: .9rem; }
    .back-link:hover { color: #e94560; }
</style>
@endpush

@section('content')
<a href="{{ route('posts.index') }}" class="back-link">&larr; Back to all posts</a>

<div class="post-header">
    <h1>{{ $post->title }}</h1>
    <div class="meta">
        <span>By {{ $post->user->name }}</span>
        @if($post->published_at)
            <span>{{ $post->published_at->format('F d, Y') }}</span>
        @endif
        @if($post->category)
            <span>in {{ $post->category->name }}</span>
        @endif
    </div>
</div>

<div class="post-body">
    {!! nl2br(e($post->body)) !!}
</div>

<div class="comments-section">
    <h2>Comments ({{ $post->comments->count() }})</h2>

    @forelse($post->comments as $comment)
        <div class="comment">
            <div class="comment-meta">
                <strong>{{ $comment->author_name }}</strong> &mdash; {{ $comment->created_at->diffForHumans() }}
            </div>
            <p>{{ $comment->body }}</p>
        </div>
    @empty
        <p style="color: #6c757d;">No comments yet. Be the first!</p>
    @endforelse

    <div class="comment-form">
        <h3>Leave a Comment</h3>
        <form action="{{ route('posts.comments.store', $post) }}" method="POST">
            @csrf
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label for="author_name">Name</label>
                    <input type="text" name="author_name" id="author_name" value="{{ old('author_name') }}" required>
                    @error('author_name') <p class="error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label for="author_email">Email</label>
                    <input type="email" name="author_email" id="author_email" value="{{ old('author_email') }}" required>
                    @error('author_email') <p class="error">{{ $message }}</p> @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="body">Comment</label>
                <textarea name="body" id="body" required>{{ old('body') }}</textarea>
                @error('body') <p class="error">{{ $message }}</p> @enderror
            </div>
            <button type="submit" class="btn">Post Comment</button>
        </form>
    </div>
</div>
@endsection
