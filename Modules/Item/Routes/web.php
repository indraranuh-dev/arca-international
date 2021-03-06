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

Route::group([
    'prefix' => '/barang',
    'middleware' => ['auth', 'role:admin'],
    'as' => 'main.item.',
], function () {
    Route::get('/', 'ItemController@index')->name('index');
});