<?php

use App\Room;

$factory->define(App\Session::class, function (Faker\Generator $faker) {
	$start = $faker->dateTimeBetween($startDate = 'now', $endDate = '+3 days');
    return [
        "title" => 'Session '.$faker->unique()->numberBetween(100,300).$faker->randomLetter(),
        "room_id" => Room::all()->random()->id,
        "start" => $start->format('Y-m-d H:00:00'),
        "end" =>  $start->modify('+2 hours')->format('Y-m-d H:00:00'),
    ];
});
