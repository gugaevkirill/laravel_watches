<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catalog\Brand;
use App\Models\Catalog\Product;

class MainController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function mainPage()
    {
        return view('index', [
            'brands' => Brand::take(9)->get(),

            'watches' => Product::where('category_slug', 'watches')->take(5)->get(),
            'jewelry' => Product::where('category_slug', 'jewelry')->take(5)->get(),
            'accessories' => Product::where('category_slug', 'accessories')->take(5)->get(),
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function aboutPage()
    {
        return view('about');
    }
}
