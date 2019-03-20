<?php

use Faker\Generator as Faker;

$factory->define(App\Appliance::class, function (Faker $faker) {
    $rand1 = random_int(1, 120);
    $rand2 = random_int(1, 120);
    $rand3 = random_int(1, abs($rand1-$rand2));
    return [
        'owner_id' => '1',
        'name' => $faker->name,
        'start_oti' => $rand2 > $rand1 ? $rand1 : $rand2, 
        'finish_oti' => $rand2 < $rand1 ? $rand1 : $rand2,
        'length_operation' => $rand3,
        'power_kWh' => mt_rand(0, 30) / 10,
        'status' => '0',
    ];
});