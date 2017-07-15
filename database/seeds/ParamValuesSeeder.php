<?php

use Illuminate\Database\Seeder;
use App\Models\Catalog\ParamValue;
use App\Models\Catalog\Param;

class ParamValuesSeeder extends Seeder
{
    /**
     * @param array $paramSlugs
     * @param array $value
     */
    private function createParamValue(array $paramSlugs, array $value)
    {
        /** @var ParamValue $valueObj */
        $valueObj = factory(ParamValue::class)->create([
            'value' => $value,
        ]);

        foreach ($paramSlugs as $slug) {
            $valueObj->params()->save(Param::findOrFail($slug));
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
        // Пол
        $this->createParamValue(['gender'], ['ru' => 'Мужские']);
        $this->createParamValue(['gender'], ['ru' => 'Женские']);
        $this->createParamValue(['gender'], ['ru' => 'Унисекс']);

        // Состояние
        $this->createParamValue(['condition'], ['ru' => 'Новые']);
        $this->createParamValue(['condition'], ['ru' => 'Б/У']);

        // Материал корпуса
        $this->createParamValue(['case_material'], ['ru' => 'Титан']);
        $this->createParamValue(['case_material'], ['ru' => 'Нержавеющая сталь']);
        $this->createParamValue(['case_material'], ['ru' => 'Платина']);
        $this->createParamValue(['case_material'], ['ru' => 'Золото']);
        $this->createParamValue(['case_material'], ['ru' => 'Серебро']);
        $this->createParamValue(['case_material'], ['ru' => 'Сталь']);

        // Механизм
        $this->createParamValue(['movement'], ['ru' => 'Механика с автоподзаводом']);

        // Материал ремешка
        $this->createParamValue(['band_material'], ['ru' => 'Кожа аллигатора']);

        // Стекло
        $this->createParamValue(['glass'], ['ru' => 'Сапфир']);
    }
}
