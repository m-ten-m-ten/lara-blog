<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 管理者を作成
        factory(App\Admin::class)->create(
            ['username' => 'admin', 'password' => bcrypt('adminpass')]
        );

        // 自分用のユーザーを作成
        factory(App\User::class)->create(
            ['name' => '自分', 'email' => 'aa@bb.net']
        );

        // 他のユーザーを作成
        factory(App\User::class, 9)->create();

        // 作成したユーザーにメッセージを登録する
        App\User::all()->each(function ($user): void {
            factory(App\Message::class, $user->id % 4)->create(['user_id' => $user->id]);
        });

        // 画像データ作成（public/imgに画像ファイル'img1.jpg'〜'img50.jpg'を入れる）
        for ($i = 1; $i < 51; $i++) {
            $image = new App\Image();
            $image->image_name = 'img' . $i;
            $image->image_extension = 'jpg';
            $image->save();
        }

        // 記事のタグを作成
        factory(App\Tag::class, 10)->create();

        // 記事カテゴリーを作成
        factory(App\Category::class, 10)->create();

        // 作成したカテゴリーに記事を1~4本作成、登録する。
        App\Category::all()->each(function ($category): void {
            factory(App\Post::class, $category->id % 4 + 1)->create(['category_id' => $category->id]);
        });

        // 作成した記事にサムネイル画像とタグを１〜３個登録する。
        // （public/thumbnailに画像ファイル'thumbnail_1.jpg'〜記事数分を入れる）
        $posts = App\Post::all();
        $tagIds = App\Tag::pluck('id');
        foreach ($posts as $post) {
            $post->post_thumbnail = 'thumbnail_' . $post->id . '.jpg';
            $post->tags()->attach($tagIds->random(mt_rand(1, 3))->toArray());
            $post->save();
        }
    }
}
