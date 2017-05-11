<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Catalog\Product;

class FeaturedProductsComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $limit = 3;
        
        $view->with('watches', Product::where('category_slug', 'watches')->take($limit)->get());
        $view->with('luxury', Product::where('category_slug', 'luxury')->take($limit)->get());
        $view->with('accessories', Product::where('category_slug', 'accessories')->take($limit)->get());
    }
}