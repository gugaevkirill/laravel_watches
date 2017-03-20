<?php

namespace App\Repositories;

use App\Models\Catalog\Category;
use App\Models\Catalog\Param;
use App\Models\Catalog\Product;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CatalogRepository
{
    const PER_PAGE = 20;
    // GET параметры, которые могут быть в запросе помимо params_slug
    const ALLOWED_QUERY = ['brands', 'page'];

    /**
     * @param Request $request
     * @return Request
     */
    public function filterRequest(Request $request): Request
    {
        return $request;

        // TODO: имплементировать метод
//        $attributes = $request->query;
//
//        unset($attributes['brands'], $attributes['page']);
//
//        // Чистим params
//        $valid = Param::whereIn('slug', array_keys($attributes))->get('slug');
//
//        return $request->fullUrlWithQuery();
    }

    /**
     * @param Request $request
     * @param Category|null $category
     * @return LengthAwarePaginator
     * @throws \Exception
     */
    public function getProductsFromRequest(Request $request, ?Category $category): LengthAwarePaginator
    {
        // Unset'им служебные переменные из запроса и загоняем их в переменные
        $attrs = $request->query->all();
        foreach (self::ALLOWED_QUERY as $key) {
            $$key = $request->get($key);
            unset($attrs[$key]);
        }

        $products = Product::query();

        // Фильтр категории
        if (isset($category)) {
            $products = $products->where('category_slug', $category->slug);
        }

        // Фильтр брендов
        if (!empty($brands)) {
            $products = $products->whereIn('brand_slug', $brands);
        }

        // Фильтр атрибутов
//        $params = Param::whereIn('slug', array_keys($attrs))->get();
        foreach ($attrs as $slug => $values) {
//            if (!is_array($values) || !($param = $params->where("slug", '==', $slug)->first())
            if (!is_array($values)
        ) {
                throw new \Exception('Attribute value must be an array');
            }

            /** @var Param $param */
            foreach ($values as &$value) {
                $value = "'$value'";
            }

            $products = $products->whereRaw(
                sprintf(
                    "attributes->>'$slug' IN (%s)",
                    implode(',', $values)
                )
            );
        }

        $products = $products->orderBy('id', 'desc')->get();
        $page = $page ?? 1;

        return new LengthAwarePaginator(
            $products->slice(($page - 1) * self::PER_PAGE, self::PER_PAGE),
            $products->count(),
            self::PER_PAGE,
            $page ?? 1
        );
    }

    /**
     * Возвращает фильтры для каталога исходя из моделей часов в наличии
     * @return Collection
     */
    public function getFilters(): Collection
    {

    }
}
