<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Post::class, function (Faker $faker) {
    $title = $faker->text(20);
    return [
        'title' => $title,
        'slug' => Str::slug($title, '-'),
        'content' => $faker->text(500),
        'category_id' => mt_rand(1, 5),
        'banner' => $faker->imageUrl(640, 480),
        'status' => mt_rand(0, 1)
    ];
});
