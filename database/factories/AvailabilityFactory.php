<?php

$factory->define(App\Availability::class, function (Faker\Generator $faker) {
    return [
        "color_id" => factory('App\Color')->create(),
        "start" => $faker->date("Y-m-d H:i:s", $max = 'now'),
        "end" => $faker->date("Y-m-d H:i:s", $max = 'now'),
        "room_id" => factory('App\Room')->create(),
        "notes" => $faker->name,
    ];
});
