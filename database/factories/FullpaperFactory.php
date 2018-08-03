<?php

$factory->define(App\Fullpaper::class, function (Faker\Generator $faker) {
    return [
        "paper_id" => App\Paper::all()->random(),
        "description" => $faker->sentence,
    ];
});
