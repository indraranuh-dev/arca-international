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
    'prefix' => '/invoice',
    'middleware' => 'auth',
    'as' => 'main.invoice.',
], function () {
    Route::get('/', 'InvoiceController@index')->name('index');
});