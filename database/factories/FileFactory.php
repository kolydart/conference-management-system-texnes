<?php

$factory->define(App\File::class, function (Faker\Generator $faker) {
    return [
        "paper_id" => factory('App\Paper')->create(),
    ];
});
