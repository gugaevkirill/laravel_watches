<?php

namespace App\Http\Controllers;

use App\Models\Catalog\Brand;
use App\Models\Catalog\Category;
use App\Models\Catalog\Product;
use App\Repositories\CatalogRepository;
use Illuminate\Database\Eloquent\Collection;
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

        return view(
            'category',
            [
                'category' => Category::findOrFail($cateogory),
                'brands' => Brand::whereIn('slug', $productsAll->pluck('brand_slug')->toArray())->get(),
                'products' => $paginator->getCollection(),
            ]
        );
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
}
