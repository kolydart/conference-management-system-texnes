<?php

$factory->define(App\Session::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
        "duration" => $faker->date("H:i:s", $max = 'now'),
        "room_id" => factory('App\Room')->create(),
        "start" => $faker->date("Y-m-d H:i:s", $max = 'now'),
        "chair" => $faker->name,
    ];
});
