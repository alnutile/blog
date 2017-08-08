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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10)
    ];
});

$factory->define(App\Project::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->name,
        'body' => $faker->realText(),
        'rendered_body' => $faker->realText(),
    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'title' => $faker->name,
        'body' => $faker->name,
        'active' => true,
        'rendered_body' => $faker->name,
    ];
});


$factory->define(App\Tag::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
    ];
});
