<?php

namespace App\Observers;

use App\Models\Catalog\Product;

class ProductObserver
{
    /**
     * @param Product $product
     */
    public function created(Product $product)
    {
        $product->url_slug = $product->generateSlug();
        $product->save();
    }
}