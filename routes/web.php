<?php

use \App\Models\Catalog\Category;

$categoryRegex = '^(' . implode('|', Category::SLUGS) . ')$';

Route::get('/', 'MainController@mainPage')->name('index');
Route::get('/repair', 'MainController@repairPage');
Route::get('/about', 'MainController@aboutPage');

Route::get('/sell', 'MainController@sellPage');
Route::post('/sell', 'MainController@processForm');

Route::get('/contacts', 'ContactsController@contactsPage')->name('contacts');
Route::post('/contacts', 'ContactsController@processForm');

Route::get('/{category}', 'CatalogController@categoryPage')
    ->where(['category' => $categoryRegex]);
Route::get('/{category}/{id}', 'CatalogController@productPage')
    ->where(['id' => '[0-9]+', 'category' => $categoryRegex]);