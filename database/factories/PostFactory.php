<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date = fake()->dateTimeBetween('-3 years', '-1 week');
        $title = fake()->sentence();
        return [
            'title' => $title,
            'content' => fake()->text(fake()->numberBetween(1000,10000)),
            'slug' => Str::slug($title, '-'),
            'created_at' => $date,
            'updated_at' => $date,
            'user_id' => rand(1,5)
        ];
    }
}
