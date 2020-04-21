<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Appointment;
use Faker\Generator as Faker;

$factory->define(Appointment::class, function (Faker $faker) {
    return [
        'is_active' => true,
        'is_deleted' => false,
        'note' => $faker->text($maxNbChars = 20),
        'date' => $faker->dateTimeBetween($startDate = '-20 days', $endDate = '+ 20 days', $timezone = null),
        'confirmed' => $faker->boolean($chanceOfGettingTrue = 50),
        'patient_id' => $faker->numberBetween($min = 1, $max = 10),
        'author_id' => $faker->numberBetween($min = 1, $max = 10),
        'place_id' => $faker->numberBetween($min = 1, $max = 10),
    ];
});
