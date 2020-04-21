<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\History;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Storage;

$factory->define(History::class, function (Faker $faker) {
    $authorId = $faker->numberBetween($min = 1, $max = 10);
    $fileUrl = "database/factories/img/sample_agreement.jpg";

    $fileExtension = pathinfo($fileUrl, PATHINFO_EXTENSION);
    $fileName = md5(microtime()) . '.' . $fileExtension;
    $fileContent = file_get_contents($fileUrl);
    $filePath = 'files/' . $authorId . '/' . $fileName;
    Storage::disk('public')->put($filePath, $fileContent);

    return [
        'is_active' => true,
        'is_deleted' => false,
        'treatments' => $faker->text($maxNbChars = 150),
        'note' => $faker->text($maxNbChars = 250),
        'date' => $faker->dateTimeBetween($startDate = '-60 days', $endDate = '+ 60 days', $timezone = null),
        'note' => $faker->text($maxNbChars = 250),
        'agreement' => $fileName,
        'patient_id' => $faker->numberBetween($min = 1, $max = 10),
        'author_id' => $authorId,
        'place_id' => $faker->numberBetween($min = 1, $max = 10),
    ];
});
