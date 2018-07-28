<?php

$factory->define(App\Paper::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
        "type" => collect(["Εισήγηση","Εργαστήριο: βιωματικές δράσεις","Εργαστήριο: καλές πρακτικές",])->random(),
        "duration" => collect(["20","45","90",])->random(),
        "name" => $faker->name,
        "email" => $faker->safeEmail,
        "attribute" => collect(["Πανεπιστημιακός","Ερευνητής","Μεταπτυχιακός φοιτητής","Εκπαιδευτικός Β/θμιας Εκπ/σης","Εκπαιδευτικός Α/θμιας Εκπ/σης","Καλλιτέχνης","Άλλο",])->random(),
        "status" => collect(["Accepted","Rejected","Pending",])->random(),
        "informed" => collect([" Unaware"," Informed",])->random(),
    ];
});
