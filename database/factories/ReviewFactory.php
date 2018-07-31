<?php

$factory->define(App\Review::class, function (Faker\Generator $faker) {
    return [
        "paper_id" => factory('App\Paper')->create(),
        "review" => collect(["Approve","Neutral","Reject",])->random(),
        "comment" => $faker->name,
        "user_id" => factory('App\User')->create(),
    ];
});
