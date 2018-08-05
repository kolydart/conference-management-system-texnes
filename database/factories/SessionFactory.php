<?php

use App\Room;
use gateweb\common\DateTime;

$factory->define(App\Session::class, function (Faker\Generator $faker) {
	$date = $faker->dateTimeBetween($startDate = '2018-10-11', $endDate = '2018-10-14')->format('Y-m-d H:m:s');
	$obj = (new DateTime($date))->setTime($faker->numberBetween(10,18),00);

    return [
        "title" => 'Session '.$faker->unique()->numberBetween(100,300).$faker->randomLetter(),
        "room_id" => Room::all()->random()->id,
        "start" => $obj->sql(),
        "end" =>  $obj->modify('+2 hours')->sql(),
    ];
});
