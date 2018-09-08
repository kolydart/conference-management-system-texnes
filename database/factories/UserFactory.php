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
    ];
});
