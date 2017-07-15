<?php

namespace App\Http\ViewComposers;

use App\Repositories\LangRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Catalog\Category;

class LayoutComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('categories', Category::all(['slug', 'name']));

        $repository = new LangRepository(Request::capture());
        $view->with('locales', $repository->getLocalesAsArray());
    }
}