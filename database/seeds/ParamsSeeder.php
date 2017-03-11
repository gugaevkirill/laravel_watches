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
            'title_ru' => 'Референс',
            'required' => true,
            'unique' => true,
        ]);
        $this->createParam([
            'slug' => 'gender',
            'title_ru' => 'Пол',
            'type' => 'select',
            'in_filter' => true,
        ]);
        $this->createParam([
            'slug' => 'condition',
            'title_ru' => 'Состояние',
            'type' => 'select',
            'in_filter' => true,
        ]);

        // Корпус
        $this->createParam([
            'slug' => 'dimensions',
            'title_ru' => 'Размеры',
        ]);
        $this->createParam([
            'slug' => 'case_material',
            'title_ru' => 'Материал корпуса',
            'type' => 'select',
        ]);
        $this->createParam([
            'slug' => 'waterproof',
            'title_ru' => 'Водонепроницаемость',
        ]);

        // Механизм
        $this->createParam([
            'slug' => 'movement',
            'title_ru' => 'Механизм',
            'type' => 'select',
        ]);

        // Ремешок
        $this->createParam([
            'slug' => 'band_material',
            'title_ru' => 'Материал ремешка',
            'type' => 'select',
        ]);

        // Стекло
        $this->createParam([
            'slug' => 'glass',
            'title_ru' => 'Стекло',
            'type' => 'select',
        ]);
    }
}
