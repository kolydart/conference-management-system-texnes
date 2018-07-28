<?php

$factory->define(App\Message::class, function (Faker\Generator $faker) {
    return [
        "paper_id" => factory('App\Paper')->create(),
        "address" => $faker->safeEmail,
        "name" => $faker->name,
        "body" => $faker->name,
    ];
});
