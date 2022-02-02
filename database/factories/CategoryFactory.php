<?php
namespace Database\Factories;
/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Category::class, function (Faker $faker) {
    $name = $faker->text(20);
    return [
        'name' => $name,
        'slug' => Str::slug($name, '-'),
        'status' => mt_rand(0, 1)
    ];
});
