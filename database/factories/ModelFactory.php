<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(Quill\User::class, function (Faker\Generator $faker) {
    return [
        'username' => $faker->username,
        'email' => $faker->safeEmail,
        'password' => bcrypt('password')
    ];
});

$factory->define(Quill\Post::class, function (Faker\Generator $faker) {
     // Number of users created in user seeder
    $totalUsers = 11;
    $title = $faker->sentence(6);

    return [
        'parent_id' => null,
        'poster_id' => mt_rand(1, $totalUsers),
        'status' => 1,
        'title' => $title,
        'slug' => str_slug($title),
        'body' => $faker->paragraph(4)
    ];
});
