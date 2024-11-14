<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Category;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::all();

        if ($categories->isEmpty()) {
            $categories = Category::factory()->count(5)->create();
        }

        $post = Post::factory()->create();

        $post->categories()->attach(
            $categories->random(rand(1, 10))->pluck('id')->toArray()
        );
    }
}
