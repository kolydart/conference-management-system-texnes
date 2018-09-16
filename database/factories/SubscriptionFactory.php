<?php

$factory->define(App\Subscription::class, function (Faker\Generator $faker) {
    return [
        "user_id" => factory('App\User')->create(),
        "paper_id" => factory('App\Paper')->create(),
        "appeared" => 0,
    ];
});
