<?php declare(strict_types=1);

namespace App\Http\Controllers\Site;

use App\Http\Controllers\ControllerAbstract;
use App\Models\Catalog;
use App\Repositories\CatalogRepository;

class Product extends ControllerAbstract
{
    /**
     * @param string $categorySlug
     * @param string $productSlug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function productPage(string $categorySlug, string $productSlug)
    {
        /** @var Catalog\Product $product */
        $product = Catalog\Product::where(Catalog\Product::URL_SLUG, $productSlug)->firstOrFail();
        /** @var Catalog\Category $category */
        $category = Catalog\Category::findOrFail($categorySlug);

        $productImages = [];
        foreach ($product->imagesnew as $image) {
            $productImages[] = $product->getImageUrl($image);
        }

        return view(
            'product',
            [
                'brandName' => $product->brand->name,
                'brandHref' => $product->brand->getHref(),
                'brandImage' => $product->brand->getImageUrl($product->brand->imagenew),

                'categoryName' => $category->name,

                'productDescription' => $product->descriptionnew,
                'productName' => $product->name,
                'productPrice' => $product->getPriceString(),
                'productIsReserved' => $product->is_reserved,
                'productAttrs' => $product->getAttrsForProductPage(),
                'productImages' => $productImages,

                'featuredItems' => CatalogRepository::getFeaturedProducts($product),
            ]
        );
    }
}
