<?php

use App\Models\Catalog\Category;
use App\Models\Catalog\Brand;
use App\Models\Catalog\Param;
use App\Models\Catalog\ParamValue;
use App\Models\Catalog\Product;
use Faker\Generator;


/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Category::class, function (Generator $faker) {
    $faker = $faker->unique();
    return [
        'slug' => $faker->word . str_random(5),
        'name_ru' => $faker->name,
        'name_en' => $faker->name,
        'order' => random_int(1000, 9999),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Brand::class, function (Generator $faker) {
    $faker = $faker->unique();
    return [
        'slug' => $faker->word . str_random(5),
        'name' => $faker->name,
    ];
});

// Нельзя будет воспользоваться этой фабрикой без указания типа Product'a
/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Param::class, function (Generator $faker) {
    $faker = $faker->unique();
    return [
        'slug' => $faker->word . str_random(5),
        'title_ru' => $faker->unique()->word . str_random(5),
        'title_en' => $faker->word . str_random(5),
        'type' => 'string',
        'required' => false,
        'unique' => false,
        'in_filter' => false,
        'order' => 100,
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(ParamValue::class, function (Generator $faker) {
    $faker = $faker->unique();
    return [
        'value_ru' => $faker->word . str_random(5),
        'value_en' => $faker->word . str_random(5),
        'order' => 100,
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Product::class, function (Generator $faker) {
    $faker = $faker->unique();
    return [
        'brand_slug' => function () {
            return factory(Brand::class)->create()->slug;
        },
        'category_slug' => function () {
            return factory(Category::class)->create()->slug;
        },
        'name' => $faker->name,
        'images' => [],
        'order' => 100,
    ];
});
