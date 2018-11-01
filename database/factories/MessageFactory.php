<?php

$factory->define(App\Message::class, function (Faker\Generator $faker) {
    return [
        "paper_id" => App\Paper::all()->random(),
        "name" => $faker->name,
        "title" => $faker->sentence,
        "email" => $faker->safeEmail,
        "body" => $faker->paragraph,
        "user_id" => App\User::all()->random(),
        "page_id" => App\ContentPage::all()->random(),
    ];
});
