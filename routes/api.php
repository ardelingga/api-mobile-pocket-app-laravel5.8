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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

