<?php

$factory->define(App\Message::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "email" => $faker->safeEmail,
        "body" => $faker->paragraph,
        "paper_id" => App\Paper::all()->random(),
    ];
});
