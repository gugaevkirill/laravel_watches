<?php

use App\Models\Catalog;
use Faker\Generator;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Catalog\Brand::class, function (Generator $faker) {
    $faker = $faker->unique();
    return [
        'slug' => $faker->word . str_random(5),
        'name' => $faker->name,
    ];
});
