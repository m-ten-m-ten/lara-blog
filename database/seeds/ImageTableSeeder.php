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
    for($i = 1; $i < 51; $i++ ){
      $image = new Image();
      $image->image_name = 'img'.$i;
      $image->image_extension = 'jpg';
      $image->save();
    }
  }
}
