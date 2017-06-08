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

$factory->define(App\Licence::class, function (Faker $faker) {
    return [
        'client_id' => random_int(1, 20),
        'product_id' => random_int(1, 20),
        'order_id' => random_int(1, 20),
        'mac_address' => ($faker->macAddress),
        'hdd_id' => ($faker->macPlatformToken),
        'device_id' => ($faker->macPlatformToken),
        'longitude' => ($faker->longitude),
        'latitude' => ($faker->latitude),
        'value' => generateLicence($faker->ipv4, $faker->ipv6),
    ];
});
