<?php

$factory->define(App\Review::class, function (Faker\Generator $faker) {
    return [
        "review" => collect(["Approve","Neutral","Reject",])->random(),
    ];
});
