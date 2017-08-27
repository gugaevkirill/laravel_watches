<?php

use Illuminate\Database\Seeder;
use App\Models\Catalog;

class ParamsSeeder extends Seeder
{
    /**
     * @param array $categorySlugs
     * @param array $data
     */
    private function createParam(array $categorySlugs, array $data)
    {
        $paramObj = factory(Catalog\Param::class)->create($data);

        foreach ($categorySlugs as $slug) {
            $paramObj->categories()->save(Catalog\Category::findOrFail($slug));
        }

        echo '.';
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Общие
        $this->createParam(
            Catalog\Category::SLUGS,
            [
                'slug' => 'ref',
                'title' => [
                    'ru' => 'Референс',
                ],
                'required' => true,
                'unique' => true,
            ]
        );
        $this->createParam(
            Catalog\Category::SLUGS,
            [
                'slug' => 'gender',
                'title' => [
                    'ru' => 'Пол',
                ],
                'type' => 'select',
                'in_filter' => true,
            ]
        );
        $this->createParam(
            Catalog\Category::SLUGS,
            [
                'slug' => 'condition',
                'title' => [
                    'ru' => 'Состояние',
                ],
                'type' => 'select',
                'in_filter' => true,
            ]
        );

        // Корпус
        $this->createParam(
            Catalog\Category::SLUGS,
            [
                'slug' => 'dimensions',
                'title' => [
                    'ru' => 'Размеры',
                    ],
            ]
        );
        $this->createParam(
            Catalog\Category::SLUGS,
            [
                'slug' => 'case_material',
                'title' => [
                    'ru' => 'Материал корпуса',
                ],
                'type' => 'select',
            ]
        );
        $this->createParam(
            Catalog\Category::SLUGS,
            [
                'slug' => 'waterproof',
                'title' => [
                    'ru' => 'Водонепроницаемость',
                    ],
            ]
        );

        // Механизм
        $this->createParam(
            Catalog\Category::SLUGS,
            [
                'slug' => 'movement',
                'title' => [
                    'ru' => 'Механизм',
                ],
                'type' => 'select',
            ]
        );

        // Ремешок
        $this->createParam(
            Catalog\Category::SLUGS,
            [
                'slug' => 'band_material',
                'title' => [
                    'ru' => 'Материал ремешка',
                ],
                'type' => 'select',
            ]
        );

        // Стекло
        $this->createParam(
            Catalog\Category::SLUGS,
            [
                'slug' => 'glass',
                'title' => [
                    'ru' => 'Стекло',
                ],
                'type' => 'select',
            ]
        );
    }
}
