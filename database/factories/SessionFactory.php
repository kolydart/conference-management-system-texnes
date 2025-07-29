<?php

use App\Color;
use App\Room;

$factory->define(App\Session::class, function (Faker\Generator $faker) {
	$date = $faker->dateTimeBetween($startDate = '2018-10-11', $endDate = '2018-10-14');
	$obj = \Carbon\Carbon::instance($date)->setTime($faker->numberBetween(10,18), 0, 0);

    return [
        "title" => $faker->sentence,
        "room_id" => Room::all()->random()->id,
        "start" => $obj->format('Y-m-d H:i:s'),
        "duration" => '0'.$faker->numberBetween(1,3).':00:00',
        "chair" => $faker->name,
        "color_id" => Color::all()->random()->id,
    ];
});
