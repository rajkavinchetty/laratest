@extends('layouts.app')

@section('title', 'About')

@push('styles')
<style>
    .about-card { background: #fff; border-radius: .75rem; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,.08); max-width: 700px; }
    .about-card h1 { font-size: 1.6rem; margin-bottom: 1rem; color: #16213e; }
    .about-card p { margin-bottom: 1rem; color: #4a4a4a; }
    .about-card ul { margin: 1rem 0 1rem 1.5rem; color: #4a4a4a; }
    .about-card li { margin-bottom: .4rem; }
    .tech-badge { display: inline-block; padding: .25rem .7rem; background: #16213e; color: #a8b2d1; border-radius: 1rem; font-size: .8rem; margin: .2rem; }
</style>
@endpush

@section('content')
<div class="about-card">
    <h1>About LaraTest</h1>
    <p>This is a sample Laravel application built to test the Laravel template CI/CD pipeline on Serverplane. It serves as a starting point for validating deployments, migrations, and automated workflows.</p>

    <p>The app includes:</p>
    <ul>
        <li>Blog posts with categories</li>
        <li>User comments with moderation</li>
        <li>Database migrations and seeders</li>
        <li>Blade templating with a shared layout</li>
    </ul>

    <p style="margin-top: 1.5rem; font-size: .9rem; color: #6c757d;">Built with:</p>
    <div>
        <span class="tech-badge">Laravel 13</span>
        <span class="tech-badge">PHP 8.4</span>
        <span class="tech-badge">SQLite</span>
        <span class="tech-badge">Blade</span>
        <span class="tech-badge">Serverplane</span>
    </div>
</div>
@endsection
