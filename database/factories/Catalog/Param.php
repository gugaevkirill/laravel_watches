<?php

use App\Models\Catalog\Param;
use Faker\Generator;

// Нельзя будет воспользоваться этой фабрикой без указания типа Product'a
/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Param::class, function (Generator $faker) {
    $faker = $faker->unique();
    return [
        'slug' => $faker->word . str_random(5),
        'title' => [
            'ru' => $faker->unique()->word . str_random(5),
        ],
        'type' => 'string',
        'required' => false,
        'unique' => false,
        'in_filter' => false,
        'order' => 100,
    ];
});
