<?php

use \App\Models\Catalog\Category;

$categoryRegex = '^(' . Category::get(['slug'])->implode('slug', '|') . ')$';

Route::get('/', 'Site\Main@mainPage')->name('index');
Route::get('/about', 'Site\About@aboutPage');

Route::get('/repair', 'Site\Repair@repairPage')->name('repair.page');

Route::get('/sell', 'Site\Sell@sellPage')->name('sell.page');
Route::post('/sell', 'Site\Sell@processForm')->name('sell.process');

Route::get('/contacts', 'Site\Contacts@contactsPage')->name('contacts.page');
Route::post('/contacts', 'Site\Contacts@processForm')->name('contacts.process');

Route::get('/{category}', 'Site\Category@categoryPage')
    ->where(['category' => $categoryRegex]);
Route::get('/{category}/{id}', 'Site\Product@productPage')
    ->where(['id' => '[0-9]+', 'category' => $categoryRegex]);