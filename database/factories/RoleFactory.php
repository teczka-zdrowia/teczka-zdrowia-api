<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Role;
use Faker\Generator as Faker;

$factory->define(Role::class, function (Faker $faker) {
    return [
        'is_active' => true,
        'is_deleted' => false,
        'permission_type' => $faker->randomElement($array = array(0, 1)),
        'user_id' => $faker->numberBetween($min = 1, $max = 10),
        'place_id' => $faker->numberBetween($min = 1, $max = 10),
    ];
});
