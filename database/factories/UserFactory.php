<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    // Here I am hardcoding this role, but we could put more,
    // a relationship to user_role or user_group, or just use some package like Spatie Permissions.
    // I mean there are a lot of options to choose, here just I am leaving this simpler.
    $role = 'subscriber';
    return [
        'role' => $role,
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
