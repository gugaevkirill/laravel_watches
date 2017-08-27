<?php

use \App\Models\Catalog\Category;

Route::group(['namespace' => 'Site'], function () {
    Route::get('/', 'Main@mainPage')->name('index');
    Route::get('/about', 'About@aboutPage');

    Route::get('/repair', 'Repair@repairPage')->name('repair.page');

    Route::get('/sell', 'Sell@sellPage')->name('sell.page');
    Route::post('/sell', 'Sell@processForm')->name('sell.process');

    Route::get('/contacts', 'Contacts@contactsPage')->name('contacts.page');
    Route::post('/contacts', 'Contacts@processForm')->name('contacts.process');

    Route::get('/{category}', 'Category@categoryPage')
        ->where(['category' => Category::getRegexForRoutes()]);
    Route::get('/{category}/{id}', 'Product@productPage')
        ->where(['id' => '[0-9]+', 'category' => Category::getRegexForRoutes()]);
});
