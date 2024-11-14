<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        return view('index', [
            'postCarousel' => Post::inRandomOrder()->limit(3)
                ->select('id', 'title', 'thumbnail', 'published_at')
                ->where('status', 'published')
                ->whereHas('categories', function ($query) use ($category) {
                    $query->where('categories.id', $category->id);
                })
                ->get(),
            'posts' => Post::latest()
                ->select('id', 'title', 'thumbnail', 'published_at')
                ->where('status', 'published')
                ->whereHas('categories', function ($query) use ($category) {
                    $query->where('categories.id', $category->id);
                })
                ->paginate(9)
        ]);
    }
}
