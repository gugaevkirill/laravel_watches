<?php

namespace Tests\Unit\Repositories;

use App\Models\Catalog\Brand;
use App\Models\Catalog\Category;
use App\Models\Catalog\Param;
use App\Models\Catalog\ParamValue;
use App\Models\Catalog\Product;
use Dompdf\Exception;
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

    /**
     * @covers CatalogRepository::getProductsFromRequest()
     * @dataProvider getProductsFromRequestProvider
     * @param $input array
     */
    public function testGetProductsFromRequest(array $input)
    {
        Product::truncate();

        // Бренды для теста
        if (isset($input['brandsToCreate'])) {
            foreach ($input['brandsToCreate'] as $data) {
                factory(Brand::class)->create($data);
            }
        }

        // Категория для теста
        $category = isset($input['categoryToCreate'])
            ? factory(Category::class)->create($input['categoryToCreate'])
            : null;

        // Параметры для теста
        if (isset($input['paramsToCreate'])) {
            foreach ($input['paramsToCreate'] as $param) {
                $slug = $param['slug'];

                factory(Param::class)->create([
                    'slug' => $slug,
                    'type' => $param['type'],
                    'in_filter' => true
                ]);

                if (!isset($param['valuesCount'])) {
                    continue;
                }

                $valueIds = [];
                for ($i = 0; $i < $param['valuesCount']; $i++) {
                    /** @var ParamValue $valueObj */
                    $valueObj = factory(ParamValue::class)->create();
                    $valueObj->params()->save(factory(Param::class)->create());
                    $valueIds[] = $valueObj->id;
                }

                // Подменяем порядковые номера в GET параметрах на созданные id
                if (isset($input['getParams'][$slug])) {
                    $tmp = [];
                    foreach ($input['getParams'][$slug] as $i) {
                        $tmp[] = $i == 0 ? 0 : $valueIds[$i];
                    }
                    $input['getParams'][$slug] = $tmp;
                }
                unset($tmp);

                // Подменяем Product Attrs на ID Values'ов, созданных в тесте
                foreach ($input['productsToCreate'] as $key => $product) {
                    if (isset($product['attrs'], $product['attrs'][$slug])) {
                        $input['productsToCreate'][$key]['attrs'][$slug] = $valueIds[$product['attrs'][$slug]];
                    }
                }
            }
        }

        // Делаем все входные данные строковыми
        array_walk($input['getParams'], function (&$value, $slug) {
            if (is_array($value)) {
                array_walk($value, function(&$value) {
                    if (is_bool($value)) {
                        $value = $value ? '1' : '2';
                    }
                });

                $value = implode(',', $value);
            } elseif (is_bool($value)) {
                $value = $value ? '1' : '2';
            } else {
                $value = (string) $value;
            }
        });

        // Массив id айтемов, созданных в тесте
        $createdIds = [];
        foreach ($input['productsToCreate'] as $product) {
            $createdIds[] = factory(Product::class)->create($product)->id;
        }

        // Массив выходных Id
        $resultIds = [];
        foreach ($input['results'] as $i) {
            $resultIds[] = $createdIds[$i];
        }

        $repository = $this->getMockBuilder(CatalogRepository::class, ['filterRequest'])
            ->setMethods(['filterRequest'])
            ->getMock();
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
     */
    public function getProductsFromRequestProvider()
    {
        yield [[
            'message' => 'Лишние параметры в запросе должны сводить выдачу на нет',
            'getParams' => [
                'some_param' => [0],
                'some_other' => [1, 0],
            ],
            'results' => [],
            'paramsToCreate' => [
                ['slug' => 'some_param', 'type' => 'select', 'valuesCount' => 1],
                ['slug' => 'some_other', 'type' => 'select', 'valuesCount' => 2],
            ],
            'productsToCreate' => array_fill(0, 2, []),
        ]];

        yield [[
            'message' => 'Пагинация',
            'getParams' => [
                'page' => 2
            ],
            'results' => array_reverse(range(0, 2)),
            'productsToCreate' => array_fill(0, CatalogRepository::PER_PAGE + 3, []),
        ]];

        yield [[
            'message' => 'Бренды',
            'getParams' => [
                'brand' => 'third_brand'
            ],
            'results' => [6, 4],
            'brandsToCreate' => [
                ['slug' => 'first_brand'],
                ['slug' => 'second_brand'],
                ['slug' => 'third_brand'],
            ],
            'productsToCreate' => array_merge(
                array_fill(0, 4, []),
                [
                    ['brand_slug' => 'third_brand'],
                    [],
                    ['brand_slug' => 'third_brand'],
                    ['brand_slug' => 'first_brand'],
                ]
            ),
        ]];

        yield [[
            'message' => 'Все бренды',
            'getParams' => [
                'brand' => 0
            ],
            'results' => [7, 6, 5, 4, 3, 2, 1, 0],
            'brandsToCreate' => [
                ['slug' => 'first_brand'],
                ['slug' => 'second_brand'],
                ['slug' => 'third_brand'],
            ],
            'productsToCreate' => array_merge(
                array_fill(0, 4, []),
                [
                    ['brand_slug' => 'third_brand'],
                    [],
                    ['brand_slug' => 'third_brand'],
                    ['brand_slug' => 'first_brand'],
                ]
            ),
        ]];

        yield [[
            'message' => 'Категория',
            'getParams' => [],
            'results' => [3, 1],
            'categoryToCreate' => ['slug' => 'test_cat'],
            'productsToCreate' => [[], ['category_slug' => 'test_cat'], [], ['category_slug' => 'test_cat']],
        ]];

        yield [[
            'message' => 'Boolean атрибут',
            'getParams' => [
                'bool_param' => true,
                'another_param' => false,
            ],
            'results' => [5, 2],
            'paramsToCreate' => [
                ['slug' => 'bool_param', 'type' => 'boolean'],
                ['slug' => 'another_param', 'type' => 'boolean'],
                ['slug' => 'third_param', 'type' => 'boolean'],
            ],
            'productsToCreate' => [
                [],
                [
                    'attrs' => [
                        'bool_param' => true,
                        'another_param' => true,
                        'third_param' => false,
                    ]
                ],
                [
                    'attrs' => [
                        'bool_param' => true,
                        'another_param' => false,
                        'third_param' => false,
                    ]
                ],
                [
                    'attrs' => [
                        'bool_param' => false,
                        'another_param' => false,
                        'third_param' => true,
                    ]
                ],
                [
                    'attrs' => [
                        'bool_param' => false,
                        'another_param' => false,
                        'third_param' => false,
                    ]
                ],
                [
                    'attrs' => [
                        'bool_param' => true,
                        'another_param' => false,
                        'third_param' => true,
                    ]
                ],
            ],
        ]];

        yield [[
            'message' => 'Любое значение Boolean атрибута',
            'getParams' => [
                'bool_param' => [true],
                'another_param' => 0,
            ],
            'results' => [3, 1],
            'paramsToCreate' => [
                ['slug' => 'bool_param', 'type' => 'boolean'],
                ['slug' => 'another_param', 'type' => 'boolean'],
            ],
            'productsToCreate' => [
                [],
                [
                    'attrs' => [
                        'bool_param' => true,
                        'another_param' => true,
                    ]
                ],
                [
                    'attrs' => [
                        'bool_param' => false,
                        'another_param' => true,
                    ]
                ],
                [
                    'attrs' => [
                        'bool_param' => true,
                        'another_param' => false,
                    ]
                ],
            ],
        ]];

        yield [[
            'message' => 'Select атрибуты',
            'getParams' => [
                'select_param' => [2, 3],
            ],
            'results' => [5, 2, 0],
            'paramsToCreate' => [
                ['slug' => 'select_param', 'type' => 'select', 'valuesCount' => 4],
                ['slug' => 'bubble_param', 'type' => 'select', 'valuesCount' => 2],
            ],

            'productsToCreate' => [
                [
                    'attrs' => [
                        'select_param' => 2,
                    ]
                ],
                [],
                [
                    'attrs' => [
                        'select_param' => 3,
                    ]
                ],
                [
                    'attrs' => [
                        'bubble_param' => 0,
                    ]
                ],
                [
                    'attrs' => [
                        'select_param' => 1,
                        'bubble_param' => 0,
                    ]
                ],
                [
                    'attrs' => [
                        'select_param' => 2,
                        'bubble_param' => 1,
                    ]
                ],
                [
                    'attrs' => [
                        'select_param' => 0,
                        'bubble_param' => 1,
                    ]
                ],
            ],
        ]];

        yield [[
            'message' => 'Любое значение Select атрибута',
            'getParams' => [
                'select_param' => [0],
            ],
            'results' => [4, 3, 2, 1, 0],
            'paramsToCreate' => [
                ['slug' => 'select_param', 'type' => 'select', 'valuesCount' => 4],
                ['slug' => 'bubble_param', 'type' => 'select', 'valuesCount' => 2],
            ],
            'productsToCreate' => [
                [
                    'attrs' => [
                        'select_param' => 2,
                    ]
                ],
                [],
                [
                    'attrs' => [
                        'select_param' => 3,
                    ]
                ],
                [
                    'attrs' => [
                        'bubble_param' => 0,
                    ]
                ],
                [
                    'attrs' => [
                        'select_param' => 0,
                        'bubble_param' => 1,
                    ]
                ],
            ],
        ]];
    }
}
