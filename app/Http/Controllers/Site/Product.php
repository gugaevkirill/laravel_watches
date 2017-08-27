<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\ControllerAbstract;
use App\Models\Catalog;
use App\Repositories\CatalogRepository;

class Product extends ControllerAbstract
{
    /**
     * @param string $categorySlug
     * @param int $productId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function productPage(string $categorySlug, int $productId)
    {
        /** @var Catalog\Product $product */
        $product = Catalog\Product::findOrFail($productId);
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
                'productAttrs' => $product->getAttrsForProductPage(),
                'productImages' => $productImages,

                'featuredItems' => CatalogRepository::getFeaturedProducts($product),
            ]
        );
    }
}
