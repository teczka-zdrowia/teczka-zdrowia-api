<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Attachment;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Storage;

$factory->define(Attachment::class, function (Faker $faker) {
    $sampleFiles = [
        0 => [
            "url" => "database/factories/img/sample_attachment.jpg",
            "type" => 0,
        ],
        1 => [
            "url" => "database/factories/pdf/sample_attachment.pdf",
            "type" => 2,
        ],
    ];

    $authorId = $faker->numberBetween($min = 1, $max = 10);
    $file = $sampleFiles[$faker->numberBetween($min = 0, $max = 1)];

    $fileExtension = pathinfo($file["url"], PATHINFO_EXTENSION);
    $fileName = md5(microtime()) . '.' . $fileExtension;
    $fileContent = file_get_contents($file["url"]);
    $filePath = 'files/' . $authorId . '/' . $fileName;
    Storage::disk('public')->put($filePath, $fileContent);

    return [
        'is_active' => true,
        'is_deleted' => false,
        'title' => $faker->text($maxNbChars = 50),
        'file_type' => $file["type"],
        'file_name' => $fileName,
        'patient_id' => $faker->numberBetween($min = 1, $max = 10),
        'author_id' => $authorId,
        'history_id' => $faker->numberBetween($min = 1, $max = 200),
    ];
});
