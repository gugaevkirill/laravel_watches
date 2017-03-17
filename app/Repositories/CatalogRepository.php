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
     */
    public function getProductsFromRequest(Request $request, ?Category $category): LengthAwarePaginator
    {
        // Unset'им служебные переменные из запроса и загоняем их в переменные
        $attrs = $request->query->all();
        foreach (self::ALLOWED_QUERY as $key) {
            $$key = $request->get($key);
            unset($attrs[$key]);
        }

        // TODO: исправить тут костыль
        $products = $category ? $category->products() : Product::whereNotNull('id');

        foreach ($attrs as $param => $value) {
            dd([$param, $value]);
        }

//        $products = Product::whereIn('brand_slug', $brands);
    }

    /**
     * Возвращает фильтры для каталога исходя из моделей часов в наличии
     * @return Collection
     */
    public function getFilters(): Collection
    {

    }
}
