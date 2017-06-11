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
        'lab_id' => random_int(0, 50),
        'name' => $faker->name,
        'dob' => $faker->date(),
        'gender' => random_int(-1, 1),
        'mobile' => $faker->phoneNumber,
        'email' => $faker->email,
    ];
});
