<?php

use Illuminate\Database\Seeder;
use App\Models\Catalog\Product;

class ProductsSeeder extends Seeder
{
    /**
     * @param array $data
     */
    private function createProduct(array $data)
    {
        factory(Product::class)->create($data);
        echo '.';
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createProduct([
            'brand_slug' => 'audemars_piguet',
            'category_slug' => 'watches',
            'name' => 'Audemars Piguet Royal Oak Chronograph',
            'price_rub' => 107000,
            'images' => null,
        ]);

        $this->createProduct([
            'brand_slug' => 'chanel',
            'category_slug' => 'watches',
            'name' => 'Chanel J12 Chromatic Diamond 38 mm H2566',
            'price_rub' => 10000,
            'images' => null,
        ]);

        $this->createProduct([
            'brand_slug' => 'patek_philippe',
            'category_slug' => 'watches',
            'name' => 'Patek Philippe Minute Repeater Perpetual Calendar',
            'images' => null,
        ]);

        $this->createProduct([
            'brand_slug' => 'patek_philippe',
            'category_slug' => 'watches',
            'name' => 'Patek Philippe Nautilus 7021/1G 7021/1G-001',
            'images' => null,
        ]);

        $this->createProduct([
            'brand_slug' => 'audemars_piguet',
            'category_slug' => 'jewelry',
            'name' => 'Тестовое украшение',
            'images' => null,
        ]);

        $this->createProduct([
            'brand_slug' => 'patek_philippe',
            'category_slug' => 'accessories',
            'name' => 'Тестовый ремешок',
            'images' => null,
        ]);
    }
}
