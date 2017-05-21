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

$factory->define(App\Order::class, function (Faker $faker) {
    return [
        "client_id" => random_int(1, 20),
        "product_id" => 1,
        "promotion_id" => 0,
        "amount" => 10000,
    ];
});
