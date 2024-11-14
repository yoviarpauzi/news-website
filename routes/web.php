<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('index', [
        'postCarousel' => Post::inRandomOrder()->limit(3)
            ->select('id', 'title', 'thumbnail', 'published_at')
            ->where('status', 'published')
            ->get(),
        'posts' => Post::latest()
            ->select('id', 'title', 'thumbnail', 'published_at')
            ->where('status', 'published')
            ->paginate(9)
    ]);
});

Route::get("/categories/{id}", [CategoryController::class, 'index']);
