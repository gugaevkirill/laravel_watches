<?php

use App\Models\ContactForm;
use Faker\Generator;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(ContactForm::class, function (Generator $faker) {
    return [
        'name' => $faker->name,
        'contact' => $faker->phoneNumber,
        'message' => $faker->text(),
    ];
});
