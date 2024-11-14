<?php

namespace Database\Factories;

use App\Models\CategoryPost;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\Post;

class CategoryPostFactory extends Factory
{
    protected $model = CategoryPost::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'categories_id' => Category::inRandomOrder()->first()->id,
            'posts_id' => Post::inRandomOrder()->first()->id,
        ];
    }
}
