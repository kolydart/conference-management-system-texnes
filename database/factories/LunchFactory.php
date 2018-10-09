<?php

$factory->define(App\Lunch::class, function (Faker\Generator $faker) {
    return [
        "email" => $faker->safeEmail,
        "menu" => $faker->name,
        "confirm" => 0,
    ];
});
