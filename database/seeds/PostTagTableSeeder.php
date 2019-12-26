<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\Tag;

class PostTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = Post::all();
        $tags = Tag::all();
        foreach ($posts as $post) {
          $post->tags()->attach($tags->random(rand(1,3))->pluck('id')->toArray());
        }
    }
}
