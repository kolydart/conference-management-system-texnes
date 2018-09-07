<?php

$factory->define(App\Availability::class, function (Faker\Generator $faker) {
    return [
        "room_id" => factory('App\Room')->create(),
        "start" => $faker->date("Y-m-d H:i:s", $max = 'now'),
        "end" => $faker->date("Y-m-d H:i:s", $max = 'now'),
        "notes" => $faker->name,
    ];
});
