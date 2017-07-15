<?php

namespace App\Http\Controllers;

use App\Models\Catalog\Brand;
use App\Models\Catalog\Category;
use App\Models\Catalog\Param;
use App\Models\Catalog\Product;
use App\Repositories\CatalogRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CatalogController extends Controller
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

        $category = Category::findOrFail($cateogorySlug);
        $paginator = $repository->getProductsFromRequest($request, $category);

        /** @var Collection $productsAll */
        $productsAll = Product::where('category_slug', $cateogorySlug)->get();
        $brands = Brand::whereIn('slug', $productsAll->pluck('brand_slug')->toArray())
            ->get(['name', 'slug']);

        $params = Param::whereIn('type', ['select', 'boolean'])
            ->where('in_filter', true)
            ->join(Param::CATEGORY_PIVOT, 'param_slug', '=', 'params.slug')
            ->where('category_slug', $cateogorySlug)
            ->with('values')
            ->get(['slug', 'title', 'type'])
            ->map(function (Param $one) {
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
            'pagenInfo' => $paginator->render('parts/products-pagen')->toHtml(),
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
        /** @var Brand $brand */
        $brand = $product->brand;

        $productImages = [];
        foreach ($product->imagesnew as $image) {
            $productImages[] = $product->getImageUrl($image);
        }

        return view(
            'product',
            [
                'brandName' => $brand->name,
                'brandHref' => $brand->getHref(),
                'brandImage' => $brand->getImageUrl($brand->imagenew),

                'categoryName' => $category->name,

                'productDescription' => $product->descriptionnew,
                'productName' => $product->name,
                'productPrices' => $product->getPrices(),
                'productAttrs' => $product->getAttrsForProductPage(),
                'productImages' => $productImages,

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
