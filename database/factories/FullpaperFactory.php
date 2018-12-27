<?php

$factory->define(App\Fullpaper::class, function (Faker\Generator $faker) {
    return [
        "paper_id" => factory('App\Paper')->create(),
        "description" => $faker->name,
        "uuid" => $faker->name,
    ];
});
