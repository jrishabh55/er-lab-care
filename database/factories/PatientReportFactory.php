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
    $paid = $faker->boolean;
    $price = $faker->randomFloat(2, 200, 5000);
    $discount = $faker->randomFloat(1, 0, $price);
    $paid_amount = $paid ? $price : $faker->randomFloat(1, 1, $price - $discount);

    return [
        'price' => $price,
        'discount' => $discount,
        'paid_amount' => $paid_amount,
        'paid' => $paid,
    ];
});
