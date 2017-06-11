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

$factory->define(App\PatientTest::class, function (Faker $faker) {
    return [
        'patient_report_id' => random_int(1, 50),
        'test_id' => random_int(1, 20),
        'value' => $faker->randomNumber(2),
        'price' => $faker->randomFloat(0, 10, 50)
    ];
});
