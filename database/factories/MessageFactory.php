<?php

$factory->define(App\Message::class, function (Faker\Generator $faker) {
    return [
        "paper_id" => App\Paper::all()->random(),
        "name" => $faker->name,
        "title" => $faker->name,
        "email" => $faker->safeEmail,
        "body" => $faker->paragraph,
    ];
});
