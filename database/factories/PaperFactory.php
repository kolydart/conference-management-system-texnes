<?php

$factory->define(App\Paper::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
    ];
});
