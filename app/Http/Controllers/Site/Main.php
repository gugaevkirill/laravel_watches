<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\ControllerAbstract;
use App\Models\Catalog;

class Main extends ControllerAbstract
{
    const BRANDS_ON_MAINPAGE = 9;

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function mainPage()
    {
        $brands = collect(
            \DB::select(
                'select br.*
                    from
                      (select b.slug, count(*) as cnt from brands b left join products p on b.slug = p.brand_slug group by slug) tmp
                      left join
                      brands br
                      on tmp.slug = br.slug
                    ORDER BY cnt desc, "order" asc, "name"
                    LIMIT ?',
                [self::BRANDS_ON_MAINPAGE]
            )
        )->map(function ($rowData) {
            return new Catalog\Brand((array) $rowData);
        });

        return view('index', [
            'brands' => $brands,

            'watches' => Catalog\Product::where('category_slug', 'watches')->take(6)->get(),
            'luxury' => Catalog\Product::where('category_slug', 'luxury')->take(6)->get(),
            'accessories' => Catalog\Product::where('category_slug', 'accessories')->take(6)->get(),
        ]);
    }
}
