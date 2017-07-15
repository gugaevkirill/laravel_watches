<?php

use Illuminate\Database\Seeder;
use App\Models\Catalog\Param;

class ParamsSeeder extends Seeder
{
    /**
     * @param array $data
     */
    private function createParam(array $data)
    {
        factory(Param::class)->create($data);
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
        $this->createParam([
            'slug' => 'ref',
            'title' => [
                'ru' => 'Референс',
            ],
            'required' => true,
            'unique' => true,
        ]);
        $this->createParam([
            'slug' => 'gender',
            'title' => [
                'ru' => 'Пол',
            ],
            'type' => 'select',
            'in_filter' => true,
        ]);
        $this->createParam([
            'slug' => 'condition',
            'title' => [
                'ru' => 'Состояние',
            ],
            'type' => 'select',
            'in_filter' => true,
        ]);

        // Корпус
        $this->createParam([
            'slug' => 'dimensions',
            'title' => [
                'ru' => 'Размеры',
                ],
        ]);
        $this->createParam([
            'slug' => 'case_material',
            'title' => [
                'ru' => 'Материал корпуса',
            ],
            'type' => 'select',
        ]);
        $this->createParam([
            'slug' => 'waterproof',
            'title' => [
                'ru' => 'Водонепроницаемость',
                ],
        ]);

        // Механизм
        $this->createParam([
            'slug' => 'movement',
            'title' => [
                'ru' => 'Механизм',
            ],
            'type' => 'select',
        ]);

        // Ремешок
        $this->createParam([
            'slug' => 'band_material',
            'title' => [
                'ru' => 'Материал ремешка',
            ],
            'type' => 'select',
        ]);

        // Стекло
        $this->createParam([
            'slug' => 'glass',
            'title' => [
                'ru' => 'Стекло',
            ],
            'type' => 'select',
        ]);
    }
}
