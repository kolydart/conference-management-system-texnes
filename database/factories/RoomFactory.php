<?php

$factory->define(App\Room::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
        "description" => $faker->name,
        "type" => collect(["Αμφιθέατρο","Αίθουσα διδασκαλίας","Αίθουσα τελετών","Εξωτερικός χώρος",])->random(),
        "wifi" => collect(["full","limited","none",])->random(),
        "capacity" => $faker->randomNumber(2),
    ];
});
