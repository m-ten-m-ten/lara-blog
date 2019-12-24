<?php

use Illuminate\Database\Seeder;
use App\Image;

class ImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Image::create([
        'image_name' => 'img01',
        'image_extension' => 'jpg'
      ]);
      Image::create([
        'image_name' => 'img02',
        'image_extension' => 'jpg'
      ]);
      Image::create([
        'image_name' => 'img03',
        'image_extension' => 'jpg'
      ]);
      Image::create([
        'image_name' => 'img04',
        'image_extension' => 'jpg'
      ]);
      Image::create([
        'image_name' => 'img05',
        'image_extension' => 'jpg'
      ]);
  }
}
