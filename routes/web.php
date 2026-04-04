<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('posts.index'));

Route::resource('posts', PostController::class)->only(['index', 'show', 'create', 'store']);
Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('posts.comments.store');
