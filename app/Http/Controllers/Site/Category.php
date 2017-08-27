<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\ControllerAbstract;
use App\Models\Catalog;
use App\Repositories\CatalogRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class Category extends ControllerAbstract
{
    /**
     * @param Request $request
     * @param string $cateogorySlug
     * @param CatalogRepository $repository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function categoryPage(Request $request, string $cateogorySlug, CatalogRepository $repository)
    {
        $filteredRequest = $repository->filterRequest($request);
        if ($filteredRequest->query != $request->query) {
            return redirect($filteredRequest->getRequestUri());
        }

        $category = Catalog\Category::findOrFail($cateogorySlug);
        $paginator = $repository->getProductsFromRequest($request, $category);

        /** @var Collection $productsAll */
        $productsAll = Catalog\Product::where('category_slug', $cateogorySlug)->get();
        $brands = Catalog\Brand::whereIn('slug', $productsAll->pluck('brand_slug')->toArray())
            ->get(['name', 'slug']);

        $params = Catalog\Param::whereIn('type', ['select', 'boolean'])
            ->where('in_filter', true)
            ->join(Catalog\Param::CATEGORY_PIVOT, 'param_slug', '=', 'params.slug')
            ->where('category_slug', $cateogorySlug)
            ->with('values')
            ->get(['slug', 'title', 'type'])
            ->map(function (Catalog\Param $one) {
                $ans = $one->toArray();

                // Массив значений параметра
                $tmp = [];
                foreach ($ans['values'] as $value) {
                    $tmp['val' . $value['id']] = ['title' => $value['value']];
                }
                $ans['values'] = $tmp;

                // Для параметров, у которых значение может быть только одно
                if ($one->type == 'boolean' || ($one->type == 'select' && count($ans['values']) < 3)) {
                    $ans['value'] = '';
                }

                return $ans;
            });

        return view(
            'category',
            [
                'category' => $category,
                'brands' => $brands->toArray(),
                'brandsJSON' => $this->keyBy($brands, 'slug')->toJson(),
                'params' => $params,
                'paramsJSON' => $this->keyBy($params, 'slug')->toJson(),
                'paginator' => $paginator,
            ]
        );
    }

    /**
     * @param Collection $collection
     * @param string $key
     * @return Collection
     */
    private function keyBy(Collection $collection, string $key): Collection
    {
        return $collection->keyBy($key)->map(function ($item) use ($key) {
            unset($item[$key]);
            return $item;
        });

    }
}
