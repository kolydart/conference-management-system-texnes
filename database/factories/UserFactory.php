<?php

use gateweb\common\Presenter;

$factory->define(App\User::class, function (Faker\Generator $faker) {
	$email = $faker->safeEmail;
	$password = Presenter::before($email,'@');
    return [
        "name" => $faker->name,
        "email" => $email,
        "password" => $password,
        "role_id" => App\Role::all()->random()->id,
        "remember_token" => $password,
        "phone" => $faker->phoneNumber,
        "attribute" => collect(["Εκπαιδευτικός ΠΕ 91.01","Εκπαιδευτικός ΠΕ 79.01","Εκπαιδευτικός ΠΕ 08","Εκπαιδευτικός ΠΕ 70","Εκπαιδευτικός ΠΕ 60","Εκπαιδευτικός ΠΕ 02","Εκπαιδευτικός ΠΕ 11","Εκπαιδευτικός ΠΕ 05 / 06 / 07 / 34 / 40","Εκπαιδευτικός ΠΕ 03/ 04","Εκπαιδευτικός ΠΕ 86","Εκπαιδευτικός ΠΕ 36","Προπτυχιακός/ή Φοιτητής /τρια","Μεταπτυχιακός /η Φοιτητής / τρια","Διδάκτορας","Ανεξάρτητος Ερευνητής","Μέλος ΕΔΙΠ / ΕΕΠ","Μέλος ΔΕΠ","Ομότιμος Καθηγητής / τρια","Άλλο",])->random(),
    ];
});
