<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('user', 'UsersController',
    ['only' => ['store', 'show', 'update']]);

Route::resource('catalogs', 'CatalogsController',
    ['only' => ['store', 'show']]);

Route::get('dataFeeds/download', 'DataFeedsController@download');

Route::resource('productSet', 'ProductSetController',
    ['only' => ['store', 'show']]);
