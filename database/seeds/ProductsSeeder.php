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
            'attrs' => [
                'ref' => [
                    'ru' => 'asdf1',
                ],
            ],
        ]);

        $this->createProduct([
            'brand_slug' => 'chanel',
            'category_slug' => 'watches',
            'name' => 'Chanel J12 Chromatic Diamond 38 mm H2566',
            'price_rub' => 10000,
            'attrs' => [
                'ref' => [
                    'ru' => 'asdf2',
                ],
            ],
        ]);

        $this->createProduct([
            'brand_slug' => 'patek_philippe',
            'category_slug' => 'watches',
            'name' => 'Patek Philippe Minute Repeater Perpetual Calendar',
            'attrs' => [
                'ref' => [
                    'ru' => 'asdf3',
                ],
            ],
        ]);

        $this->createProduct([
            'brand_slug' => 'patek_philippe',
            'category_slug' => 'watches',
            'name' => 'Patek Philippe Nautilus 7021/1G 7021/1G-001',
            'attrs' => [
                'ref' => [
                    'ru' => 'asdf4',
                ],
            ],
        ]);

        $this->createProduct([
            'brand_slug' => 'audemars_piguet',
            'category_slug' => 'luxury',
            'name' => 'Тестовое украшение',
            'attrs' => [
                'ref' => [
                    'ru' => 'asdf25',
                ],
            ],
        ]);

        $this->createProduct([
            'brand_slug' => 'patek_philippe',
            'category_slug' => 'accessories',
            'name' => 'Тестовый ремешок',
            'attrs' => [
                'ref' => [
                    'ru' => 'asdf16',
                ],
            ],
        ]);
    }
}
