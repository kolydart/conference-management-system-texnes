<?php

$factory->define(App\Paper::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
        "type" => collect(["Εισήγηση","Εργαστήριο: βιωματικές δράσεις","Εργαστήριο: καλές πρακτικές",])->random(),
        "duration" => collect(["20","45","90",])->random(),
        "session_id" => factory('App\Session')->create(),
        "name" => $faker->name,
        "email" => $faker->safeEmail,
        "attribute" => collect(["Μέλος ΔΕΠ","Μέλος ΕΕΠ","Μέλος ΕΔΙΠ","Διδάκτωρ / Ερευνητής","Υποψήφιος Διδάκτωρ","Μεταπτυχιακός/ή Φοιτητής/τρια","Προπτυχιακός/ή Φοιτητής/τρια","Στέλεχος Εκπαίδευσης","Εκπαιδευτικός Πρωτοβάθμιας Εκπαίδευσης","Εκπαιδευτικός Δευτεροβάθμιας Εκπαίδευσης","Καλλιτέχνης",])->random(),
        "phone" => $faker->name,
        "abstract" => $faker->name,
        "bio" => $faker->name,
        "status" => collect(["Accepted","Rejected","Pending",])->random(),
        "informed" => collect(["Unaware","Informed",])->random(),
        "order" => $faker->randomNumber(2),
        "capacity" => $faker->randomNumber(2),
        "objectives" => $faker->name,
        "materials" => $faker->name,
        "description" => $faker->name,
        "evaluation" => $faker->name,
        "video" => $faker->name,
        "bibliography" => $faker->name,
        "lab_approved" => 0,
    ];
});
