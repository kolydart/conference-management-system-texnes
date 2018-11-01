<?php

$factory->define(App\Message::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "email" => $faker->safeEmail,
        "title" => $faker->name,
        "body" => $faker->name,
        "user_id" => factory('App\User')->create(),
        "page_id" => factory('App\ContentPage')->create(),
        "paper_id" => factory('App\Paper')->create(),
    ];
});
