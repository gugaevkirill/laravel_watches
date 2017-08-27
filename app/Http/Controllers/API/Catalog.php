<?php declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\ControllerAbstract;
use App\Models\Catalog\Category;
use App\Repositories\CatalogRepository;
use Illuminate\Http\Request;

class Catalog extends ControllerAbstract
{
    /**
     * @param Request $request
     * @param string $cateogory
     * @param CatalogRepository $repository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function categoryAPI(Request $request, string $cateogory, CatalogRepository $repository)
    {
        $filteredRequest = $repository->filterRequest($request);
        if ($filteredRequest->query != $request->query) {
            return abort(404);
        }

        // Просто чтобы проверить существование категории
        Category::findOrFail($cateogory);
        $paginator = $repository->getProductsFromRequest($request, Category::find($cateogory));

        return response()->json([
            'pagenInfo' => $paginator->render('parts/products-pagen')->toHtml(),
            'html' => $paginator->render('parts/products-list')->toHtml(),
            'countInfo' => $paginator->render('parts/products-count')->toHtml(),
        ]);
    }
}
