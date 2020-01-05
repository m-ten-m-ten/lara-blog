<?php

use App\Post;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Post::truncate();

        factory(Post::class, 30)->create();

        $posts = Post::all();

        foreach ($posts as $post) {
            $post->post_thumbnail = 'thumbnail_' . $post->id . '.jpg';
            $post->save();
        }
    }
}
