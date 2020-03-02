<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 20),
        'content' => $faker->sentence(10),
        'image' => 'https://mk0nationaltodayijln.kinstacdn.com/wp-content/uploads/2019/01/museum-selfie-day-1200x834.jpg'
    ];
});
