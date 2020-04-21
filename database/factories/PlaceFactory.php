<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Place;
use Faker\Generator as Faker;
use Faker\Provider\pl_PL\Company as Company;
use Faker\Provider\pl_PL\Address as Address;

$factory->define(Place::class, function (Faker $faker) {
    $faker->addProvider(new Company($faker));
    $faker->addProvider(new Address($faker));

    return [
        'is_active' => true,
        'is_deleted' => false,
        'name' => $faker->company,
        'address' => $faker->streetName,
        'city' => $faker->city,
    ];
});
