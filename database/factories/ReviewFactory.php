<?php

$factory->define(App\Review::class, function (Faker\Generator $faker) {
    return [
        "paper_id" => factory('App\Paper')->create(),
        "review" => collect(["Approve","Neutral","Reject",])->random(),
        "comment" => $faker->paragraph,
        "user_id" => collect([1,2,3,4])->random(),
    ];
});
