<?php

use App\Models\Catalog\Category;
use Faker\Generator;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Category::class, function (Generator $faker) {
    $faker = $faker->unique();
    return [
        'slug' => $faker->word . str_random(5),
        'name' => [
            'ru' => $faker->lastName,
            'en' => $faker->firstName,
        ],
        'order' => random_int(-32767, 32767),
    ];
});
