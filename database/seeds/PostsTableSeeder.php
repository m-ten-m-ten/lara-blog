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
        Post::create([
          'post_title' => 'タイトル01',
          'post_content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis iste modi possimus eum, similique saepe magnam perspiciatis sunt inventore nobis quod, ipsum minima molestiae magni amet obcaecati doloremque commodi aliquid!',
          'post_excerpt' => '要約文01',
          'post_status' => 'drafted',
          'post_drafted' => '2019-12-01 15:18:00',
          'post_name' => 'title01'
        ]);
        Post::create([
          'post_title' => 'タイトル02',
          'post_content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis iste modi possimus eum, similique saepe magnam perspiciatis sunt inventore nobis quod, ipsum minima molestiae magni amet obcaecati doloremque commodi aliquid!',
          'post_excerpt' => '要約文02',
          'post_status' => 'drafted',
          'post_drafted' => '2019-12-02 15:18:00',
          'post_name' => 'title02'
        ]);
        Post::create([
          'post_title' => 'タイトル03',
          'post_content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis iste modi possimus eum, similique saepe magnam perspiciatis sunt inventore nobis quod, ipsum minima molestiae magni amet obcaecati doloremque commodi aliquid!',
          'post_excerpt' => '要約文03',
          'post_status' => 'drafted',
          'post_drafted' => '2019-12-03 15:18:00',
          'post_name' => 'title03'
        ]);
        Post::create([
          'post_title' => 'タイトル04',
          'post_content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis iste modi possimus eum, similique saepe magnam perspiciatis sunt inventore nobis quod, ipsum minima molestiae magni amet obcaecati doloremque commodi aliquid!',
          'post_excerpt' => '要約文04',
          'post_status' => 'published',
          'post_published' => '2019-12-04 15:18:00',
          'post_name' => 'title04'
        ]);
        Post::create([
          'post_title' => 'タイトル05',
          'post_content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis iste modi possimus eum, similique saepe magnam perspiciatis sunt inventore nobis quod, ipsum minima molestiae magni amet obcaecati doloremque commodi aliquid!',
          'post_excerpt' => '要約文05',
          'post_status' => 'published',
          'post_published' => '2019-12-05 15:18:00',
          'post_name' => 'title05'
        ]);
        Post::create([
          'post_title' => 'タイトル06',
          'post_content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis iste modi possimus eum, similique saepe magnam perspiciatis sunt inventore nobis quod, ipsum minima molestiae magni amet obcaecati doloremque commodi aliquid!',
          'post_excerpt' => '要約文06',
          'post_status' => 'published',
          'post_published' => '2019-12-06 15:18:00',
          'post_name' => 'title06'
        ]);
        Post::create([
          'post_title' => 'タイトル07',
          'post_content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis iste modi possimus eum, similique saepe magnam perspiciatis sunt inventore nobis quod, ipsum minima molestiae magni amet obcaecati doloremque commodi aliquid!',
          'post_excerpt' => '要約文07',
          'post_status' => 'published',
          'post_published' => '2019-12-07 15:18:00',
          'post_name' => 'title07'
        ]);
        Post::create([
          'post_title' => 'タイトル08',
          'post_content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis iste modi possimus eum, similique saepe magnam perspiciatis sunt inventore nobis quod, ipsum minima molestiae magni amet obcaecati doloremque commodi aliquid!',
          'post_excerpt' => '要約文08',
          'post_status' => 'published',
          'post_published' => '2019-12-08 15:18:00',
          'post_name' => 'title08'
        ]);
        Post::create([
          'post_title' => 'タイトル09',
          'post_content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis iste modi possimus eum, similique saepe magnam perspiciatis sunt inventore nobis quod, ipsum minima molestiae magni amet obcaecati doloremque commodi aliquid!',
          'post_excerpt' => '要約文09',
          'post_status' => 'published',
          'post_published' => '2019-12-09 15:18:00',
          'post_name' => 'title09'
        ]);
        Post::create([
          'post_title' => 'タイトル10',
          'post_content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis iste modi possimus eum, similique saepe magnam perspiciatis sunt inventore nobis quod, ipsum minima molestiae magni amet obcaecati doloremque commodi aliquid!',
          'post_excerpt' => '要約文10',
          'post_status' => 'published',
          'post_published' => '2019-12-10 15:18:00',
          'post_name' => 'title10'
        ]);
        Post::create([
          'post_title' => 'タイトル11',
          'post_content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis iste modi possimus eum, similique saepe magnam perspiciatis sunt inventore nobis quod, ipsum minima molestiae magni amet obcaecati doloremque commodi aliquid!',
          'post_excerpt' => '要約文11',
          'post_status' => 'published',
          'post_published' => '2019-12-11 15:18:00',
          'post_name' => 'title11'
        ]);
        Post::create([
          'post_title' => 'タイトル12',
          'post_content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis iste modi possimus eum, similique saepe magnam perspiciatis sunt inventore nobis quod, ipsum minima molestiae magni amet obcaecati doloremque commodi aliquid!',
          'post_excerpt' => '要約文12',
          'post_status' => 'published',
          'post_published' => '2019-12-12 15:18:00',
          'post_name' => 'title12'
        ]);
        Post::create([
          'post_title' => 'タイトル13',
          'post_content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis iste modi possimus eum, similique saepe magnam perspiciatis sunt inventore nobis quod, ipsum minima molestiae magni amet obcaecati doloremque commodi aliquid!',
          'post_excerpt' => '要約文13',
          'post_status' => 'published',
          'post_published' => '2019-12-13 15:18:00',
          'post_name' => 'title13'
        ]);
        Post::create([
          'post_title' => 'タイトル14',
          'post_content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis iste modi possimus eum, similique saepe magnam perspiciatis sunt inventore nobis quod, ipsum minima molestiae magni amet obcaecati doloremque commodi aliquid!',
          'post_excerpt' => '要約文14',
          'post_status' => 'published',
          'post_published' => '2019-12-14 15:18:00',
          'post_name' => 'title14'
        ]);
        Post::create([
          'post_title' => 'タイトル15',
          'post_content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis iste modi possimus eum, similique saepe magnam perspiciatis sunt inventore nobis quod, ipsum minima molestiae magni amet obcaecati doloremque commodi aliquid!',
          'post_excerpt' => '要約文15',
          'post_status' => 'published',
          'post_published' => '2019-12-15 15:18:00',
          'post_name' => 'title15'
        ]);
        Post::create([
          'post_title' => 'タイトル16',
          'post_content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis iste modi possimus eum, similique saepe magnam perspiciatis sunt inventore nobis quod, ipsum minima molestiae magni amet obcaecati doloremque commodi aliquid!',
          'post_excerpt' => '要約文16',
          'post_status' => 'published',
          'post_published' => '2019-12-16 15:18:00',
          'post_name' => 'title16'
        ]);
        Post::create([
          'post_title' => 'タイトル17',
          'post_content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis iste modi possimus eum, similique saepe magnam perspiciatis sunt inventore nobis quod, ipsum minima molestiae magni amet obcaecati doloremque commodi aliquid!',
          'post_excerpt' => '要約文17',
          'post_status' => 'published',
          'post_published' => '2019-12-17 15:18:00',
          'post_name' => 'title17'
        ]);
        Post::create([
          'post_title' => 'タイトル18',
          'post_content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis iste modi possimus eum, similique saepe magnam perspiciatis sunt inventore nobis quod, ipsum minima molestiae magni amet obcaecati doloremque commodi aliquid!',
          'post_excerpt' => '要約文18',
          'post_status' => 'published',
          'post_published' => '2019-12-18 15:18:00',
          'post_name' => 'title18'
        ]);
        Post::create([
          'post_title' => 'タイトル19',
          'post_content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis iste modi possimus eum, similique saepe magnam perspiciatis sunt inventore nobis quod, ipsum minima molestiae magni amet obcaecati doloremque commodi aliquid!',
          'post_excerpt' => '要約文19',
          'post_status' => 'published',
          'post_published' => '2019-12-19 15:18:00',
          'post_name' => 'title19'
        ]);
        Post::create([
          'post_title' => 'タイトル20',
          'post_content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis iste modi possimus eum, similique saepe magnam perspiciatis sunt inventore nobis quod, ipsum minima molestiae magni amet obcaecati doloremque commodi aliquid!',
          'post_excerpt' => '要約文20',
          'post_status' => 'published',
          'post_published' => '2019-12-20 15:18:00',
          'post_name' => 'title20'
        ]);
        Post::create([
          'post_title' => 'タイトル21',
          'post_content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis iste modi possimus eum, similique saepe magnam perspiciatis sunt inventore nobis quod, ipsum minima molestiae magni amet obcaecati doloremque commodi aliquid!',
          'post_excerpt' => '要約文21',
          'post_status' => 'published',
          'post_published' => '2019-12-21 15:18:00',
          'post_name' => 'title21'
        ]);
        Post::create([
          'post_title' => 'タイトル22',
          'post_content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis iste modi possimus eum, similique saepe magnam perspiciatis sunt inventore nobis quod, ipsum minima molestiae magni amet obcaecati doloremque commodi aliquid!',
          'post_excerpt' => '要約文22',
          'post_status' => 'published',
          'post_published' => '2019-12-22 15:18:00',
          'post_name' => 'title22'
        ]);
        Post::create([
          'post_title' => 'タイトル23',
          'post_content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis iste modi possimus eum, similique saepe magnam perspiciatis sunt inventore nobis quod, ipsum minima molestiae magni amet obcaecati doloremque commodi aliquid!',
          'post_excerpt' => '要約文23',
          'post_status' => 'published',
          'post_published' => '2019-12-23 15:18:00',
          'post_name' => 'title23'
        ]);

    }
}
