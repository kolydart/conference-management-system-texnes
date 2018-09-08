<?php

$factory->define(App\Availability::class, function (Faker\Generator $faker) {
    return [
        "type" => collect(["green","black","yellow",])->random(),
        "start" => $faker->date("Y-m-d H:i:s", $max = 'now'),
        "end" => $faker->date("Y-m-d H:i:s", $max = 'now'),
        "room_id" => factory('App\Room')->create(),
        "notes" => $faker->name,
    ];
});
