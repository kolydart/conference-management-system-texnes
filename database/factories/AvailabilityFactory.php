<?php

use App\Room;

$factory->define(App\Availability::class, function (Faker\Generator $faker) {
	$date = $faker->dateTimeBetween($startDate = '2018-10-11', $endDate = '2018-10-14');
	$obj = \Carbon\Carbon::instance($date)->setTime($faker->numberBetween(10,18), 0, 0);

    return [
        "room_id" => collect([Room::all()->random()->id, null])->random(),
        "color_id" => factory('App\Color')->create(),
        "start" => $obj->format('Y-m-d H:i:s'),
        "end" => $obj->copy()->addHours(collect([1,2,3])->random())->format('Y-m-d H:i:s'),
        "notes" => $faker->sentence,
    ];
});
