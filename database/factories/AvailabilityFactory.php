<?php

use App\Room;
use gateweb\common\DateTime;

$factory->define(App\Availability::class, function (Faker\Generator $faker) {
	$date = $faker->dateTimeBetween($startDate = '2018-10-11', $endDate = '2018-10-14')->format('Y-m-d H:m:s');
	$obj = (new DateTime($date))->setTime($faker->numberBetween(10,18),00);

    return [
        "room_id" => collect(Room::all()->random()->id,null)->random(),
        "color_id" => factory('App\Color')->create(),
        "start" => $obj->sql(),
        "end" => $obj->modify('+'.collect([1,2,3,])->random().' hour')->sql(),
        "notes" => $faker->sentence,
    ];
});
