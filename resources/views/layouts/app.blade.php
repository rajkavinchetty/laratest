<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'LaraTest') }} - @yield('title', 'Home')</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; line-height: 1.6; color: #1a1a2e; background: #f0f2f5; }
        .container { max-width: 1100px; margin: 0 auto; padding: 0 1.5rem; }
        header { background: #16213e; color: #fff; padding: 1rem 0; box-shadow: 0 2px 4px rgba(0,0,0,.1); }
        header .container { display: flex; justify-content: space-between; align-items: center; }
        header h1 { font-size: 1.4rem; }
        header h1 a { color: #e94560; text-decoration: none; }
        nav a { color: #a8b2d1; text-decoration: none; margin-left: 1.5rem; font-size: .95rem; transition: color .2s; }
        nav a:hover { color: #e94560; }
        main { padding: 2rem 0; }
        .alert { padding: .75rem 1rem; border-radius: .5rem; margin-bottom: 1.5rem; font-size: .95rem; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        footer { text-align: center; padding: 2rem 0; color: #94a3b8; font-size: .85rem; background: #16213e; margin-top: 2rem; }
    </style>
    @stack('styles')
</head>
<body>
    <header>
        <div class="container">
            <h1><a href="{{ url('/') }}">LaraTest</a></h1>
            <nav>
                <a href="{{ route('posts.index') }}">Blog</a>
                <a href="{{ route('posts.create') }}">New Post</a>
                <a href="{{ route('about') }}">About</a>
            </nav>
        </div>
    </header>

    <main class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @yield('content')
    </main>

    <footer>
        <div class="container">
            <p>LaraTest &mdash; Laravel CI/CD Template for Serverplane &mdash; {{ date('Y') }}</p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
