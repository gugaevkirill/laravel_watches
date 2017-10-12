<?php declare(strict_types=1);

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

            'featured' => $this->getFeaturedProducts(),
        ]);
    }

    public function getFeaturedProducts(): array
    {
        $result = [];

        foreach (Catalog\Category::all() as $cat) {
            /** @var Catalog\Category $cat */
            $products = Catalog\Product::where('category_slug', $cat->slug)
                ->take(6)
                ->get();

            if (!$products->count()) {
                continue;
            }

            $result[] = [
                'title' => $cat->name,
                'products' => $products,
            ];
        }

        return $result;
    }
}
