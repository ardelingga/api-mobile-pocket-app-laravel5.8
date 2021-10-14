<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/list_dompet', 'DompetController@index');
Route::post('/add_dompet', 'DompetController@add');
Route::post('/edit_dompet', 'DompetController@edit');
Route::post('/delete_dompet', 'DompetController@delete');

Route::get('/status_dompet', 'DompetStatusController@index');

Route::get('/list_kategori', 'KategoriController@index');
Route::post('/add_kategori', 'KategoriController@add');
Route::post('/edit_kategori', 'KategoriController@edit');
Route::post('/delete_kategori', 'KategoriController@delete');

Route::get('/status_kategori', 'KategoriStatusController@index');

Route::get('/list_transaksi', 'TransaksiController@index');
Route::post('/add_transaksi', 'TransaksiController@add');
Route::post('/id_generator', 'TransaksiController@idGenerator');
Route::post('/edit_transaksi', 'TransaksiController@edit');
Route::post('/delete_transaksi', 'TransaksiController@delete');

Route::get('/status_transaksi', 'TransaksiStatusController@index');



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

