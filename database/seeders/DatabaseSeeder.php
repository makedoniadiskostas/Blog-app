<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::factory(5)->create();
        $tags = Tag::factory(15)->create();
        Post::factory(20)->has(Comment::factory(5))->create()->each(function ($post) {
            $post->tags()->attach(rand(1, 3));
            $post->tags()->attach(rand(4, 7));
            $post->tags()->attach(rand(8, 15));
        });
    }
}
