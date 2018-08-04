<?php

$factory->define(App\Room::class, function (Faker\Generator $faker) {
    return [
        "title" => 'Room '.$faker->numberBetween(410,950),
        "description" => $faker->sentence,
    ];
});
