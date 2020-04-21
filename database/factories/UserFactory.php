<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\User;
use Faker\Generator as Faker;
use Faker\Provider\pl_PL\Person as Person;
use Faker\Provider\pl_PL\PhoneNumber as PhoneNumber;

$factory->define(User::class, function (Faker $faker) {
    $faker->addProvider(new Person($faker));

    return [
        'password' => bcrypt("secret123"),
        'pesel' => $faker->pesel,
        'name' => $faker->name,
        'specialization' => $faker->text($maxNbChars = 15),
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'is_deleted' => false,
        'rules_accepted' => true,
        'paid_until' => $faker->dateTimeBetween($startDate = '-60 days', $endDate = '+ 60 days', $timezone = null),
    ];
});
