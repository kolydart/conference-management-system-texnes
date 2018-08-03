<?php

$factory->define(App\ContentPage::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->sentence,
        "page_text" => $faker->paragraph,
        "excerpt" => $faker->sentence,
    ];
});
