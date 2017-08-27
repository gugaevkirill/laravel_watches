<?php

use App\Models\Catalog\ParamValue;
use Faker\Generator;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(ParamValue::class, function (Generator $faker) {
    $faker = $faker->unique();
    return [
        'value' => [
            'ru' => $faker->word . str_random(5),
        ],
        'order' => 100,
    ];
});
