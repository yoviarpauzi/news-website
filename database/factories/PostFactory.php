<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class PostFactory extends Factory
{
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Ensure the 'attachments' directory exists
        Storage::disk('public')->makeDirectory('attachments');

        return [
            'users_id' => User::inRandomOrder()->first()->id,
            'thumbnail' => 'attachments/' . $this->faker->unique()->image(Storage::disk('public')->path('attachments'), 640, 480, null, false),
            'title' => $this->faker->unique()->sentence(),
            'slug' => Str::slug($this->faker->unique()->sentence()),
            'content' => $this->generateWysiwygContent(),
            'view_count' => $this->faker->numberBetween(0, 1000),
            'status' => 'published',
            'published_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }

    /**
     * Generate mock WYSIWYG content using Faker.
     *
     * @return string
     */
    private function generateWysiwygContent(): string
    {
        $htmlContent = "<p>" . implode("</p><p>", $this->faker->paragraphs(rand(3, 7))) . "</p>";
        $htmlContent .= "<h2>" . $this->faker->sentence() . "</h2>";
        $htmlContent .= "<p><strong>" . $this->faker->sentence() . "</strong></p>";
        $htmlContent .= "<ul><li>" . implode("</li><li>", $this->faker->words(rand(3, 6))) . "</li></ul>";

        return $htmlContent;
    }
}
