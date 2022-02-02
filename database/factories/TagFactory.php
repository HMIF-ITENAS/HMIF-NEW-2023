<?php
namespace Database\Factories;
/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tag;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Tag::class, function (Faker $faker) {
    $name = $faker->text(5);
    return [
        'name' => $name,
        'slug' => Str::slug($name, '-'),
        'status' => mt_rand(0, 1)
    ];
});
