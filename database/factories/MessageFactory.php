<?php

$factory->define(App\Message::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "email" => $faker->safeEmail,
        "title" => $faker->name,
        "paper_id" => factory('App\Paper')->create(),
        "body" => $faker->name,
    ];
});
