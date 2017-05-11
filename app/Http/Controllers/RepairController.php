<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catalog\Brand;
use App\Models\Catalog\Product;

class RepairController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function repairPage()
    {
        return view('repair');
    }
}
