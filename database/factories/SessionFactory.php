<?php

use App\Room;

$factory->define(App\Session::class, function (Faker\Generator $faker) {
	$date = $faker->dateTimeBetween($startDate = '2018-10-11', $endDate = '2018-10-14');
	$time = $faker->numberBetween(10,18);
    return [
        "title" => 'Session '.$faker->unique()->numberBetween(100,300).$faker->randomLetter(),
        "room_id" => Room::all()->random()->id,
        "start" => $date->format('Y-m-d ').$time.':00:00',
        "end" =>  $date->format('Y-m-d ').($time+2).':00:00',
        // "end" =>  $date->modify('+2 hours')->format('Y-m-d H:00:00'),
    ];
});
