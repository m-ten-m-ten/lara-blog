<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'post_title'     => $faker->text($maxNbChars = 30),
        'post_content'   => $faker->realText($maxNbChars = 10000, $indexSize = 5),
        'post_excerpt'   => $faker->realText($maxNbChars = 150, $indexSize = 1),
        'post_status'    => 'published',
        'post_published' => $faker->dateTime($max = 'now', $timezone = null),
        'post_name'      => $faker->slug,
        'category_id'    => $faker->numberBetween($min = 1, $max = 10),
    ];
});
