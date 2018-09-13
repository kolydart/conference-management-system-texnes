<?php

$factory->define(App\ContentPage::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->sentence,
        "alias" => $faker->word,
        "page_text" => $faker->paragraph,
        "excerpt" => $faker->paragraph,
    ];
});
