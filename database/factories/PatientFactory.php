<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Patient::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'dob' => $faker->date(),
        'gender' => $faker->boolean,
        'number' => $faker->numberBetween(10000000000, 1999999999),
        'email' => $faker->email,
    ];
});
