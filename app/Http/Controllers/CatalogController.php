<?php

namespace App\Http\Controllers;

use App\Models\Catalog\Brand;
use App\Models\Catalog\Category;
use App\Models\Catalog\Product;
use Dompdf\Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    /**
     * @param Request $request
     * @param string $cateogory
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function categoryPage(Request $request, string $cateogory)
    {
        /** @var Collection $productsAll */
        $productsAll = Product::where('category_slug', $cateogory)->get();

        return view(
            'category',
            [
                'category' => Category::findOrFail($cateogory),
                'brands' => Brand::whereIn('slug', $productsAll->pluck('brand_slug')->toArray())->get(),
                'products' => Product::where('category_slug', $cateogory)->get(),
            ]
        );
    }

    /**
     * @param string $cateogory
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function productPage(string $cateogory, int $id)
    {
        return view('product_template');
    }
}
