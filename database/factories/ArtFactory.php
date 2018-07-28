<?php

$factory->define(App\Art::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
    ];
});
