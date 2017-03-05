<?php

Route::get('/', 'MainController@mainPage')->name('index');
Route::get('/repair', 'MainController@repairPage');
Route::get('/sell', 'MainController@sellPage');
Route::get('/about', 'MainController@aboutPage');

Route::get('/contacts', 'ContactsController@contactsPage')->name('contacts');
Route::post('/contacts', 'ContactsController@processForm');

Route::get('/{category}', 'CatalogController@categoryPage')
    ->where(['category' => 'watches|jewelry|accessories']);
Route::get('/{category}/{id}', 'CatalogController@productPage')
    ->where(['id' => '[0-9]+', 'category' => 'watches|jewelry|accessories']);