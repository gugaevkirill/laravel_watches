<?php

namespace App\Http\Controllers;

use App\Models\Catalog\Brand;
use App\Models\Catalog\Category;
use App\Models\Catalog\Product;

class MainController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function mainPage()
    {
        return view('index', [
            'brands' => Brand::take(9)->get(), // TODO: вытаскивать те бренды, по которым есть часы

            'watches' => Product::where('category_slug', 'watches')->take(6)->get(),
            'luxury' => Product::where('category_slug', 'luxury')->take(6)->get(),
            'accessories' => Product::where('category_slug', 'accessories')->take(6)->get(),
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function aboutPage()
    {
        return view(
            'about',
            [
                'brands' => Brand::getWithProducts(6),
            ]
        );
    }
}
