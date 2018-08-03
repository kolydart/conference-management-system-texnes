<?php

$factory->define(App\Message::class, function (Faker\Generator $faker) {
    return [
        "paper_id" => factory('App\Paper')->create(),
        "name" => $faker->name,
        "title" => $faker->name,
        "email" => $faker->safeEmail,
        "body" => $faker->name,
    ];
});
