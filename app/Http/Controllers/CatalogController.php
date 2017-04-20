<?php

namespace App\Http\Controllers;

use App\Models\Catalog\Brand;
use App\Models\Catalog\Category;
use App\Models\Catalog\Product;
use App\Repositories\CatalogRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

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

        return view(
            'category',
            [
                'category' => Category::findOrFail($cateogory),
                'brands' => $brands->toArray(),
                'brandsJSON' => $this->keyBy($brands, 'slug')->toJson(),
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
