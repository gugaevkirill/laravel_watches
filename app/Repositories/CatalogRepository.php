<?php

namespace App\Repositories;

use App\Models\Catalog\Category;
use App\Models\Catalog\Param;
use App\Models\Catalog\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class CatalogRepository
{
    const PER_PAGE = 20;
    // GET параметры, которые могут быть в запросе помимо params_slug
    const ALLOWED_QUERY = ['brand', 'page'];

    /**
     * @param Request $request
     * @return Request
     */
    public function filterRequest(Request $request): Request
    {
        return $request;

        // TODO: имплементировать метод
//        $attrs = $request->query;
//
//        unset($attrs['brands'], $attrs['page']);
//
//        // Чистим params
//        $valid = Param::whereIn('slug', array_keys($attrs))->get('slug');
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
        $attrs = array_merge(
            $request->query->all(),
            $request->request->all()
        );
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
        if (!empty($brand)) {
            $products = $products->where('brand_slug', $brand);
        }

//         Фильтр атрибутов
        $params = Param::whereIn('slug', array_keys($attrs))->get();
        foreach ($attrs as $slug => $value) {
            if ($value == "0") {
                // TODO: тест на это. Если у value значение 0 - значит это все
                continue;
            }

            if (!is_string($value)
                || !($param = $params->where("slug", '==', $slug)->first())
            ) {
                throw new \Exception('Invalid URL');
            }

            if ($param->type == 'boolean') {
                $value = $value === '1' ? 'true' : 'false';
            }

            $products = $products->whereRaw("(attrs->'$slug')::jsonb <@ '[$value]'::jsonb");
        }

        $products = $products->get();

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

    /**
     * @param Product $product
     * @return Collection
     */
    public static function getFeaturedProducts(Product $product): Collection
    {
        // TODO: заюзать кеш для этого
        return Product::where('category_slug', $product->category_slug)
            ->orderByRaw("random()")
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();
    }
}
