<?php

$factory->define(App\Paper::class, function (Faker\Generator $faker) {
    $types = ["Εισήγηση","Εργαστήριο: βιωματικές δράσεις","Εργαστήριο: καλές πρακτικές",];
    $durations = ["20","45","90",];
    $i = collect([0,1,2])->random();
    return [
        "title" => $faker->sentence,
        "type" => $types[$i],
        "duration" => $durations[$i],
        "name" => $faker->name,
        "email" => $faker->safeEmail,
        "attribute" => collect(["Πανεπιστημιακός","Ερευνητής","Μεταπτυχιακός φοιτητής","Εκπαιδευτικός Β/θμιας Εκπ/σης","Εκπαιδευτικός Α/θμιας Εκπ/σης","Καλλιτέχνης","Άλλο",])->random(),
        "phone" => $faker->phoneNumber,
        "status" => collect(["Accepted","Rejected","Pending",])->random(),
        "informed" => collect(['Unaware','Informed'])->random(),
    ];
});
