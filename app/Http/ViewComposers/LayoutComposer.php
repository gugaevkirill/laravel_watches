<?php

namespace App\Http\ViewComposers;

use App\Models\Catalog\Product;
use App\Repositories\CurrencyRepository;
use App\Repositories\LangRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
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

        $langRepository = new LangRepository();
        $view->with('locales', $langRepository->getLocalesAsArray());

        $currencyRepository = new CurrencyRepository();
        $view->with('currency', $currencyRepository->getCurrency());
        $view->with('currencies', CurrencyRepository::ALLOWED_CURRENCIES);
    }
}