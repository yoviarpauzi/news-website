<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Category;

class CategoryPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::all();
        $posts = Post::all();

        if ($categories->isEmpty() || $posts->isEmpty()) {
            $this->command->info('No categories or posts found. Please ensure you have categories and posts in your database before running this seeder.');
            return;
        }

        // Associate existing posts with random existing categories
        $posts->each(function ($post) use ($categories) {
            $post->categories()->attach(
                $categories->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
