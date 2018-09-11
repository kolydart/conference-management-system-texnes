<?php

$factory->define(App\Color::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->hexcolor,
        "description" => $faker->word,
    ];
});
