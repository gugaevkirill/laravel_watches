<?php

use App\Models\Catalog\Category;
use App\Models\Catalog\Brand;
use App\Models\Catalog\Param;
use App\Models\Catalog\ParamValue;
use App\Models\Catalog\Product;
use Faker\Generator;


/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Category::class, function (Generator $faker) {
    return [
        'slug' => $faker->word,
        'name_ru' => $faker->name,
        'name_en' => $faker->name,
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Brand::class, function (Generator $faker) {
    return [
        'slug' => $faker->word,
        'name' => $faker->name,
        'image' => $faker->image(),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Param::class, function (Generator $faker) {
    return [
        'slug' => $faker->word,
        'title_ru' => $faker->word,
        'title_en' => $faker->word,
        'type' => array_rand(Param::TYPES),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(ParamValue::class, function (Generator $faker) {
    return [
        'param_slug' => function () {
            return factory(Param::class)->create()->slug;
        },
        'value_ru' => $faker->word,
        'value_en' => $faker->word,
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Product::class, function (Generator $faker) {
    return [
        'brand_slug' => function () {
            return factory(Brand::class)->create()->slug;
        },
        'category_slug' => function () {
            return factory(Category::class)->create()->slug;
        },
        'name' => $faker->name,
        'images' => [$faker->image()],
    ];
});
