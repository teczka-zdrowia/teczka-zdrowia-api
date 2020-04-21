<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Recommendation;
use Faker\Generator as Faker;

$factory->define(Recommendation::class, function (Faker $faker) {
    return [
        'is_active' => true,
        'is_deleted' => false,
        'title' => $faker->text($maxNbChars = 20),
        'description' => $faker->text($maxNbChars = 30),
        'start_date' => $faker->dateTimeBetween($startDate = '-6 days', $endDate = '+ 6 days', $timezone = null),
        'days' => $faker->numberBetween($min = 0, $max = 10),
        'patient_id' => $faker->numberBetween($min = 1, $max = 10),
        'author_id' => $faker->numberBetween($min = 1, $max = 10),
        'history_id' => $faker->numberBetween($min = 1, $max = 200),
    ];
});
