<?php

use App\Http\Controllers\ItemController;
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



Route::controller(ItemController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/items/{id}', 'ItemController@show');
    Route::post('/items', 'store')->name('items.store');
    Route::post('/items/search', 'search')->name('items.search');
    Route::get('/items/{id}', 'destroy')->name('items.destroy');
});
