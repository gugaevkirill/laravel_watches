<?php

use Illuminate\Database\Seeder;
use App\Models\Catalog\ParamValue;
use App\Models\Catalog\Param;

class ParamValuesSeeder extends Seeder
{
    /**
     * @param array $paramSlugs
     * @param string $valueRu
     */
    private function createParamValue(array $paramSlugs, string $valueRu)
    {
        /** @var ParamValue $valueObj */
        $valueObj = factory(ParamValue::class)->create([
            'value_ru' => $valueRu,
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
        $this->createParamValue(['gender'], 'Мужские');
        $this->createParamValue(['gender'], 'Женские');
        $this->createParamValue(['gender'], 'Унисекс');

        // Состояние
        $this->createParamValue(['condition'], 'Новые');
        $this->createParamValue(['condition'], 'Б/У');

        // Материал корпуса
        $this->createParamValue(['case_material'], 'Титан');
        $this->createParamValue(['case_material'], 'Нержавеющая сталь');
        $this->createParamValue(['case_material'], 'Платина');
        $this->createParamValue(['case_material'], 'Золото');
        $this->createParamValue(['case_material'], 'Серебро');
        $this->createParamValue(['case_material'], 'Сталь');

        // Механизм
        $this->createParamValue(['movement'], 'Механика с автоподзаводом');

        // Материал ремешка
        $this->createParamValue(['band_material'], 'Кожа аллигатора');

        // Стекло
        $this->createParamValue(['glass'], 'Сапфир');
    }
}
