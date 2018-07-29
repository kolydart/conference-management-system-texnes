<?php

$factory->define(App\Judgement::class, function (Faker\Generator $faker) {
    return [
        "paper_id" => factory('App\Paper')->create(),
        "judgement" => collect(["Approve","Neutral","Reject",])->random(),
        "comment" => $faker->name,
        "user_id" => factory('App\User')->create(),
    ];
});
