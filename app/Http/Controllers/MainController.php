<?php

namespace App\Http\Controllers;

use App\Models\Catalog\Brand;
use App\Models\Catalog\Category;
use App\Models\Catalog\Product;

class MainController extends Controller
{
    const BRANDS_ON_MAINPAGE = 9;

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function mainPage()
    {
        foreach (Product::all() as $product) {
            $new = [];
            foreach ($product->images as $imgOld) {
                $filename = crc32($imgOld . microtime());
                $image = \Image::make($imgOld);
                \Storage::disk()->put($product->getImageDestination($filename), $image->stream());
                $new[] = $filename;
            }

            $product->setAttribute('imagesnew', $new);
            $product->save();
        }


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
            return new Brand((array) $rowData);
        });

        return view('index', [
            'brands' => $brands,

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
