<?php

use App\Models\SellForm;
use Faker\Generator;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(SellForm::class, function (Generator $faker) {
    return [
        'name' => $faker->name,
        'image' => $faker->image(),
        'phone' => $faker->phoneNumber,
    ];
});
