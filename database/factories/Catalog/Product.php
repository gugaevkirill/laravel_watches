<?php

use App\Models\Catalog\Brand;
use App\Models\Catalog\Category;
use App\Models\Catalog\Product;
use Faker\Generator;

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
        'imagesnew' => [-1],
        'order' => 100,
    ];
});
