<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\ControllerAbstract;
use App\Models\Catalog\Brand;

class About extends ControllerAbstract
{
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
