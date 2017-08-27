<?php

use \App\Models\Catalog\Category;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register the API routes for your application as
| the routes are automatically authenticated using the API guard and
| loaded automatically by this application's RouteServiceProvider.
|
*/

Route::group(['namespace' => 'API'], function () {
    Route::any('{category}', 'Catalog@categoryAPI')
        ->where(['category' => Category::getRegexForRoutes()]);
});
