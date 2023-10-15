<?php

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/get-data-from-api', 'ApiController@getDataFromApi');
// routes/web.php
Route::get('/produk', 'ProdukController@index');
Route::get('/produk/create', 'ProdukController@create')->name('produk.create');
Route::post('/produk', 'ProdukController@store')->name('produk.store');
Route::get('/produk/{id}/edit', 'ProdukController@edit')->name('produk.edit');
Route::put('/produk/{id}', 'ProdukController@update')->name('produk.update');;
Route::get('/produk/{id}/delete', 'ProdukController@destroy')->name('produk.destroy');
