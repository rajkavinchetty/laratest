@extends('layouts.app')

@section('title', 'Create Post')

@push('styles')
<style>
    .form-card { background: #fff; border-radius: .75rem; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,.08); max-width: 750px; }
    .form-card h1 { font-size: 1.5rem; margin-bottom: 1.5rem; color: #16213e; }
    .form-group { margin-bottom: 1.25rem; }
    .form-group label { display: block; margin-bottom: .3rem; font-weight: 600; font-size: .9rem; color: #333; }
    .form-group input, .form-group textarea, .form-group select { width: 100%; padding: .6rem .8rem; border: 1px solid #ddd; border-radius: .4rem; font-size: .95rem; font-family: inherit; }
    .form-group textarea { resize: vertical; min-height: 200px; }
    .form-group input:focus, .form-group textarea:focus, .form-group select:focus { outline: none; border-color: #e94560; box-shadow: 0 0 0 3px rgba(233,69,96,.1); }
    .btn { display: inline-block; padding: .6rem 1.5rem; background: #e94560; color: #fff; border: none; border-radius: .4rem; font-size: .95rem; cursor: pointer; }
    .btn:hover { background: #c73652; }
    .error { color: #dc3545; font-size: .85rem; margin-top: .25rem; }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
    .back-link { display: inline-block; margin-bottom: 1.5rem; color: #6c757d; text-decoration: none; font-size: .9rem; }
    .back-link:hover { color: #e94560; }
</style>
@endpush

@section('content')
<a href="{{ route('posts.index') }}" class="back-link">&larr; Back to all posts</a>

<div class="form-card">
    <h1>Create New Post</h1>

    <form action="{{ route('posts.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" required>
            @error('title') <p class="error">{{ $message }}</p> @enderror
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id">
                    <option value="">-- None --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status">
                    <option value="draft" @selected(old('status') === 'draft')>Draft</option>
                    <option value="published" @selected(old('status') === 'published')>Published</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="excerpt">Excerpt <span style="font-weight:400;color:#6c757d;">(optional)</span></label>
            <input type="text" name="excerpt" id="excerpt" value="{{ old('excerpt') }}">
            @error('excerpt') <p class="error">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label for="body">Body</label>
            <textarea name="body" id="body" required>{{ old('body') }}</textarea>
            @error('body') <p class="error">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="btn">Create Post</button>
    </form>
</div>
@endsection
