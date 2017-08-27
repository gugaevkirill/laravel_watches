<?php

use Illuminate\Database\Seeder;
use \App\Models\Catalog\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * @param array $data
     */
    private function createCategory(array $data)
    {
        factory(Category::class)->create($data);
        echo '.';
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createCategory([
            'slug' => 'watches',
            'order' => 1,
            'name' => [
                'ru' => 'Часы',
                'en' => 'Watches',
            ],
        ]);

        $this->createCategory([
            'slug' => 'accessories',
            'order' => 2,
            'name' => [
                'ru' => 'Аксессуары',
                'en' => 'Accessories',
            ],
        ]);

        $this->createCategory([
            'slug' => 'luxury',
            'order' => 3,
            'name' => [
                'ru' => 'Элитные товары',
                'en' => 'Luxury products',
            ],
        ]);
    }
}
