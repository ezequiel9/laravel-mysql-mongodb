<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $user = \App\Models\User::where('role', 'administrator')->inRandomOrder()->first();
    $images = ['image1.jpg', 'image2.jpg', 'image3.jpg', 'image4.jpg', 'image5.jpg', 'image6.jpg'];
    $image = array_rand($images, 1);
    $title = $faker->text(rand(30, 100));
    $slug = Str::slug($title);

    return [
        'title' => $faker->text(rand(30, 100)),
        'slug' => $slug,
        'subtitle' => $faker->text(144),
        'content' => $faker->paragraphs(rand(5, 15), true),
        'author_id' => $user->id,
        'image' => '../images/'.$images[$image]
    ];
});
