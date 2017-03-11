<?php

use \App\Models\Catalog\Category;

$categoryRegex = '^(' . implode('|', Category::SLUGS) . ')$';

Route::get('/', 'MainController@mainPage')->name('index');
Route::get('/about', 'MainController@aboutPage');

Route::get('/repair', 'RepairController@repairPage')->name('repair.page');
Route::post('/repair', 'RepairController@processForm')->name('repair.process');

Route::get('/sell', 'SellController@sellPage')->name('sell.page');
Route::post('/sell', 'MainController@processForm')->name('sell.process');

Route::get('/contacts', 'ContactsController@contactsPage')->name('contacts.page');
Route::post('/contacts', 'ContactsController@processForm')->name('contacts.process');

Route::get('/{category}', 'CatalogController@categoryPage')
    ->where(['category' => $categoryRegex]);
Route::get('/{category}/{id}', 'CatalogController@productPage')
    ->where(['id' => '[0-9]+', 'category' => $categoryRegex]);