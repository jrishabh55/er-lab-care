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

$factory->define(App\PatientReport::class, function (Faker $faker) {
    return [
        'patient_id' => random_int(1, 20),
        'price' => $faker->randomFloat(2, 200, 5000),
        'discount' => $faker->randomFloat(0, 10, 200)
    ];
});
