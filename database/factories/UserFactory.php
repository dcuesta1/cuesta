<?php

use Faker\Generator as Faker;


$factory->define(Api\User::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'username' => $faker->userName,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = authenticator()->encrypt('password'),
    ];
});
