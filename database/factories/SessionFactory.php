<?php

$factory->define(App\Session::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
        "room_id" => factory('App\Room')->create(),
        "start" => $faker->date("Y-m-d H:i:s", $max = 'now'),
        "end" => $faker->date("Y-m-d H:i:s", $max = 'now'),
    ];
});
