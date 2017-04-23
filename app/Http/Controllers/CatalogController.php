<?php

namespace App\Http\Controllers;

use App\Models\Catalog\Brand;
use App\Models\Catalog\Category;
use App\Models\Catalog\Param;
use App\Models\Catalog\Product;
use App\Repositories\CatalogRepository;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    /**
     * @param Request $request
     * @param string $cateogory
     * @param CatalogRepository $repository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function categoryPage(Request $request, string $cateogory, CatalogRepository $repository)
    {
        $filteredRequest = $repository->filterRequest($request);
        if ($filteredRequest->query != $request->query) {
            return redirect($filteredRequest->getRequestUri());
        }

        $paginator = $repository->getProductsFromRequest($request, Category::find($cateogory));

        /** @var Collection $productsAll */
        $productsAll = Product::where('category_slug', $cateogory)->get();
        $brands = Brand::whereIn('slug', $productsAll->pluck('brand_slug')->toArray())
            ->get(['name', 'slug']);

        $params = Param::whereIn('type', ['select', 'boolean'])
            ->where('in_filter', true)
            ->with('values')
            // TODO: получать нужный title в зависимости от языка
            ->get(['slug', 'title_ru', 'type'])
            ->map(function (Param $one) {
                $ans = $one->toArray();
                $ans['title'] = $ans['title_ru'];
                unset($ans['title_ru']);

                $tmp = [];
                foreach ($ans['values'] as $value) {
                    $tmp['val' . $value['id']] = ['title' => $value['value_ru']];
                }
                $ans['values'] = $tmp;

                return $ans;
            });

        return view(
            'category',
            [
                'category' => Category::findOrFail($cateogory),
                'brands' => $brands->toArray(),
                'brandsJSON' => $this->keyBy($brands, 'slug')->toJson(),
                'params' => $params,
                'paramsJSON' => $this->keyBy($params, 'slug')->toJson(),
                'paginator' => $paginator,
            ]
        );
    }

    /**
     * @param Request $request
     * @param string $cateogory
     * @param CatalogRepository $repository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function categoryAPI(Request $request, string $cateogory, CatalogRepository $repository)
    {
        $filteredRequest = $repository->filterRequest($request);
        if ($filteredRequest->query != $request->query) {
            return abort(404);
        }

        // Просто чтобы проверить существование категории
        $category = Category::findOrFail($cateogory);
        $paginator = $repository->getProductsFromRequest($request, Category::find($cateogory));

        return response()->json([
            'totalPages' => $paginator->lastPage(),
            'html' => $paginator->render('parts/products-list')->toHtml(),
            'countInfo' => $paginator->render('parts/products-count')->toHtml(),
        ]);
    }

    /**
     * @param string $categorySlug
     * @param int $productId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function productPage(string $categorySlug, int $productId)
    {
        $product = Product::find($productId);
        $category = Category::findOrFail($categorySlug);
        $brand = $product->brand;

        return view(
            'product',
            [
                'brandName' => $brand->name,
                'brandHref' => $brand->getHref(),
                'brandImage' => $brand->image,

                'categoryName' => $category->name_ru,

                'productName' => $product->name,
                'productPrices' => $product->getPrices(),
                'productAttrs' => $product->getAttrsForProductPage(),
                'productImages' => $product->images,

                'featuredItems' => CatalogRepository::getFeaturedProducts($product),
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
