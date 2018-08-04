<?php

$factory->define(App\Paper::class, function (Faker\Generator $faker) {
    $types = ["Εισήγηση","Εργαστήριο: βιωματικές δράσεις","Εργαστήριο: καλές πρακτικές",];
    $durations = ["20","45","90",];
    $i = collect([0,1,2])->random();
    return [
        "title" => $faker->sentence,
        "type" => $types[$i],
        "duration" => $durations[$i],
        // "session_id" => factory('App\Session')->create(),
        "name" => $faker->name,
        "email" => $faker->safeEmail,
        "attribute" => collect(["Μέλος ΔΕΠ","Μέλος ΕΕΠ","Μέλος ΕΔΙΠ","Διδάκτωρ / Ερευνητής","Υποψήφιος Διδάκτωρ","Μεταπτυχιακός/ή Φοιτητής/τρια","Προπτυχιακός/ή Φοιτητής/τρια","Στέλεχος Εκπαίδευσης","Εκπαιδευτικός Πρωτοβάθμιας Εκπαίδευσης","Εκπαιδευτικός Δευτεροβάθμιας Εκπαίδευσης","Καλλιτέχνης",])->random(),
        "phone" => $faker->phoneNumber,
        "status" => collect(["Accepted","Rejected","Pending",])->random(),
        "informed" => collect(['Unaware','Informed'])->random(),
    ];
});
