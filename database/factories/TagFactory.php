<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tag;
use Faker\Generator as Faker;

$factory->define(Tag::class, function (Faker $faker) {
    return [
        'tag_title' => $faker->unique()->word(),
        'tag_name' => $faker->unique()->slug(),
    ];
});
