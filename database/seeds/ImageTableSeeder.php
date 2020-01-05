<?php

use App\Image;
use Illuminate\Database\Seeder;

class ImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i < 51; $i++) {
            $image = new Image();
            $image->image_name = 'img' . $i;
            $image->image_extension = 'jpg';
            $image->save();
        }
    }
}
