<?php

$factory->define(App\Art::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->word,
    ];
});
