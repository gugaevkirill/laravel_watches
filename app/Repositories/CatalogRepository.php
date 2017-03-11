<?php

namespace App\Repositories;

use App\Models\Catalog\Category;
use App\Models\Catalog\Param;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CatalogRepository
{
    const PER_PAGE = 20;

    public function filterRequest(Request $request): Request
    {
        $attributes = $request->query;
        unset($attributes['brands'], $attributes['page']);

        $realAttrs = Param::whereIn('slug', array_keys($attributes))->get();
        $fakeAttrs = array_diff(array_keys($attributes));
    }

    /**
     * @param Request $request
     * @param Category|null $category
     * @return LengthAwarePaginator
     */
    public function getProductsFromRequest(Request $request, ?Category $category): LengthAwarePaginator
    {
        $filteredRequest = $this->filterRequest($request);
        if ($filteredRequest->query != $request->query) {
            return redirect($filteredRequest->getRequestUri());
        }


    }

    /**
     * Возвращает фильтры для каталога исходя из моделей часов в наличии
     * @return Collection
     */
    public function getFilters(): Collection
    {

    }
}
