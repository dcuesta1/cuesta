<?php

use Faker\Generator as Faker;

$factory->define(\App\Invoice::class, function (Faker $faker) {
    return [
        'user_id' => 2,
        'number' => 'DN-'.$faker->randomNumber(4),
        'cost' => $faker->numberBetween($min = 100000, $max = 900000),
        'status' => \App\Invoice::CLOSED
    ];
});


