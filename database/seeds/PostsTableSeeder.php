<?php

use Illuminate\Database\Seeder;
use App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // Post::truncate();

      factory(Post::class, 30)->create();

      $posts = Post::all();
      foreach ($posts as $post) {
        $post->post_thumbnail = 'thumbnail_'.$post->id.'.jpg';
        $post->save();
      }
    }
}
