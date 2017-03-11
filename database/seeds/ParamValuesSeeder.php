<?php

use Illuminate\Database\Seeder;
use App\Models\Catalog\ParamValue;

class ParamValuesSeeder extends Seeder
{
    /**
     * @param array $data
     */
    private function createParamValue(array $data)
    {
        factory(ParamValue::class)->create($data);
        echo '.';
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Пол
        $this->createParamValue([
            'param_slug' => 'gender',
            'value_ru' => 'Мужские',
        ]);
        $this->createParamValue([
            'param_slug' => 'gender',
            'value_ru' => 'Женские',
        ]);
        $this->createParamValue([
            'param_slug' => 'gender',
            'value_ru' => 'Унисекс',
        ]);

        // Состояние
        $this->createParamValue([
            'param_slug' => 'condition',
            'value_ru' => 'Новые',
        ]);
        $this->createParamValue([
            'param_slug' => 'condition',
            'value_ru' => 'Б/У',
        ]);

        // Материал корпуса
        $this->createParamValue([
            'param_slug' => 'case_material',
            'value_ru' => 'Титан',
        ]);
        $this->createParamValue([
            'param_slug' => 'case_material',
            'value_ru' => 'Нержавеющая сталь',
        ]);
        $this->createParamValue([
            'param_slug' => 'case_material',
            'value_ru' => 'Платина',
        ]);
        $this->createParamValue([
            'param_slug' => 'case_material',
            'value_ru' => 'Золото',
        ]);
        $this->createParamValue([
            'param_slug' => 'case_material',
            'value_ru' => 'Серебро',
        ]);
        $this->createParamValue([
            'param_slug' => 'case_material',
            'value_ru' => 'Сталь',
        ]);

        // Механизм
        $this->createParamValue([
            'param_slug' => 'movement',
            'value_ru' => 'Механика с автоподзаводом',
        ]);

        // Материал ремешка
        $this->createParamValue([
            'param_slug' => 'band_material',
            'value_ru' => 'Кожа аллигатора',
        ]);

        // Стекло
        $this->createParamValue([
            'param_slug' => 'glass',
            'value_ru' => 'Сапфир',
        ]);
    }
}
