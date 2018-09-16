<?php

$factory->define(App\Subscription::class, function (Faker\Generator $faker) {
    return [
        "user_id" => App\User::all()->random()->id,
        "paper_id" => App\Paper::all()->random()->id,
        "appeared" => collect([0,1])->random()
    ];
});
