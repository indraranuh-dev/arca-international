<?php

use App\Http\Controllers\MediaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Auth::routes(['verify' => false]);

Route::get('/images/blogs/{imageName}', [MediaController::class, 'getBlogImage'])->name('getBlogImage');
Route::get('/images/services/{imageName}', [MediaController::class, 'getServiceImage'])->name('getServiceImage');
Route::get('/images/clients/{imageName}', [MediaController::class, 'getClientImage'])->name('getClientImage');