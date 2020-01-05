<?php

use App\Post;
use App\Tag;
use Illuminate\Database\Seeder;

class PostTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = Post::all();
        $tags = Tag::all();

        foreach ($posts as $post) {
            $post->tags()->attach($tags->random(\mt_rand(1, 3))->pluck('id')->toArray());
        }
    }
}
