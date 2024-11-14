<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class Home extends Controller
{
    public function index()
    {
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
    }
}
