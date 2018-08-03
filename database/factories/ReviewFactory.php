<?php

use App\Paper;
use App\User;

$factory->define(App\Review::class, function (Faker\Generator $faker) {
    return [
        "user_id" => User::find(['role_id'=>4])->random()->id,
        "paper_id" => Paper::all()->random()->id,
        "review" => collect(["Approve","Neutral","Reject",])->random(),
        "comment" => $faker->paragraph,
        "user_id" => collect([1,2,3,4])->random(),
    ];
});
