<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatalogController extends Controller
{
    /**
     * @param string $cateogory
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function categoryPage(string $cateogory)
    {
        return view('category');
    }

    /**
     * @param string $cateogory
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function productPage(string $cateogory, int $id)
    {
        return view('product');
    }
}
