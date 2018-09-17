<?php

use App\Room;

$factory->define(App\Availability::class, function (Faker\Generator $faker) {
    return [
        "room_id" => Room::all()->random(),
        "color_id" => factory('App\Color')->create(),
        "start" => $faker->date("Y-m-d H:i:s", $max = 'now'),
        "end" => $faker->date("Y-m-d H:i:s", $max = 'now'),
        "notes" => $faker->sentence,
    ];
});
