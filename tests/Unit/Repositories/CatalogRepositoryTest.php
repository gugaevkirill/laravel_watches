<?php

namespace Tests\Unit\Repositories;

use App\Models\Catalog\Brand;
use App\Models\Catalog\Category;
use App\Models\Catalog\Param;
use App\Models\Catalog\ParamValue;
use App\Models\Catalog\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CatalogRepository;
use Illuminate\Http\Request;


class CatalogRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    public function testFilterRequest()
    {
        $this->markTestIncomplete();
//        $request = Request::create($input['uri'], $input['method'], );

        // Ошибка на POST
        // Валидные не удалит
        // Несуществующие параметры
        // Несуществующие значения
        // Несовпадение типов значений - строка
        // Несовпадение типов значений - селект
        // Несовпадение типов значений - число
        // Несовпадение типов значений - boolean ??
    }

    /**
     * @covers CatalogRepository::getProductsFromRequest()
     * @dataProvider getProductsFromRequestProvider
     * @param $input array
     */
    public function testGetProductsFromRequest(array $input)
    {
        // Бренды для теста
        if (isset($input['getParams']['brands'])) {
            foreach ($input['getParams']['brands'] as $slug) {
                factory(Brand::class)->create(['slug' => $slug]);
            }
        }

        // Категория для теста
        $category = isset($input['category'])
            ? factory(Category::class)->create(['slug' => $input['category']])
            : null;

        // Параметры для теста
        if (isset($input['paramsToCreate'])) {
            foreach ($input['paramsToCreate'] as $param) {
                factory(Param::class)->create([
                    'slug' => $param['slug'],
                    'type' => $param['type'],
                    'in_filter' => true
                ]);

                $valueIds = [];
                for ($i = 0; $i < $param['valuesCount'] ?? 0; $i++) {
                    $valueIds[] = factory(ParamValue::class)->create([
                        'param_slug' => $param['slug']
                    ])->id;
                }

                // Подменяем порядковые номера в GET параметрах на созданные id
                if (isset($input['getParams'][$param['slug']])) {
                    foreach ($input['getParams'][$param['slug']] as &$i) {
                        $i = $valueIds[$i];
                    }
                }
            }
        }

        // Массив id айтемов, созданных в тесте
        $createdIds = [];
        foreach ($input['productsData'] as $product) {
            $createdIds[] = factory(Product::class)->create($product)->id;
        }

        // Массив выходных Id
        $resultIds = [];
        foreach ($input['results'] as $i) {
            $resultIds[] = $createdIds[$i];
        }

        $repository = $this->createMock(CatalogRepository::class, ['filterRequest']);
        $repository->method('filterRequest')->willReturnArgument(0);
        $paginator = $repository->getProductsFromRequest(new Request($input['getParams']), $category);

        $this->assertEquals(
            $resultIds,
            $paginator->getCollection()->pluck('id')->toArray(),
            $input['message']
        );
    }

    /**
     * 'results' => порядковые номера айтемов в массиве созданных, которые должны вернуться методом
     * @return array
     */
    public function getProductsFromRequestProvider(): array
    {
        $ans = [];

        $ans[] = [[
            'message' => 'Лишние параметры в запросе не должны фильтровать выдачу',
            'getParams' => [
                'some_param' => 'some_value',
                'some_other' => ['val1', 'val2'],
            ],
            'productsData' => array_fill(0, 4, []),
            'results' => array_reverse(range(0, 3)),
        ]];

        $ans[] = [[
            'message' => 'Пагинация',
            'getParams' => [
                'page' => 2
            ],
            'productsData' => array_fill(0, CatalogRepository::PER_PAGE + 3, []),
            'results' => array_reverse(range(0, 3)),
        ]];

        $ans[] = [[
            'message' => 'Бренды',
            'getParams' => [
                'brands' => ['first_brand', 'third_brand']
            ],
            'productsData' => array_fill(0, 4, []),
            'results' => array_reverse(range(0, 4)),
        ]];

        $ans[] = [[
            'message' => 'Категория',
            'getParams' => [],
            'category' => 'test_cat',
            'productsData' => [[], ['category_slug' => 'test_cat'], [], ['category_slug' => 'test_cat']],
            'results' => [3, 1],
        ]];

        $ans[] = [[
            'message' => 'Boolean атрибут',
            'paramsToCreate' => [
                ['slug' => 'bool_param', 'type' => 'boolean'],
                ['slug' => 'another_param', 'type' => 'boolean'],
                ['slug' => 'third_param', 'type' => 'boolean'],
            ],
            'getParams' => [
                'bool_param' => [true],
                'another_param' => [true, false],
            ],
            'productsData' => [
                [],
                [
                    'params' => [
                        'bool_param' => true,
                        'another_param' => true,
                        'third_param' => false,
                    ]
                ],
                [
                    'params' => [
                        'bool_param' => false,
                        'another_param' => true,
                        'third_param' => false,
                    ]
                ],
                [
                    'params' => [
                        'bool_param' => false,
                        'another_param' => false,
                        'third_param' => true,
                    ]
                ],
                [
                    'params' => [
                        'bool_param' => false,
                        'another_param' => false,
                        'third_param' => false,
                    ]
                ],
                [
                    'params' => [
                        'bool_param' => true,
                        'another_param' => false,
                        'third_param' => true,
                    ]
                ],
            ],
            'results' => [5, 1],
        ]];

        $ans[] = [[
            'message' => 'Select атрибуты',
            'paramsToCreate' => [
                ['slug' => 'select_param', 'type' => 'select', 'valuesCount' => 4],
                ['slug' => 'bubble_param', 'type' => 'select', 'valuesCount' => 2],
            ],
            'getParams' => [
                'select_param' => [2, 3],
            ],
            'productsData' => [
                [
                    'params' => [
                        'select_param' => [2],
                    ]
                ],
                [],
                [
                    'params' => [
                        'select_param' => [3],
                    ]
                ],
                [
                    'params' => [
                        'bubble_param' => [0],
                    ]
                ],
                [
                    'params' => [
                        'select_param' => [1, 0],
                        'bubble_param' => [0],
                    ]
                ],
                [
                    'params' => [
                        'select_param' => [1, 2],
                        'bubble_param' => [1],
                    ]
                ],
                [
                    'params' => [
                        'select_param' => [0],
                        'bubble_param' => [0, 1],
                    ]
                ],
            ],
            'results' => [5, 4, 0],
        ]];

        return $ans;
    }

    /**
     * @covers CatalogRepository::getFilters()
     */
    public function testGetFilters()
    {
        $this->markTestIncomplete();
    }
}
