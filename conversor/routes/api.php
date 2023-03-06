<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/product','ProductController@all');
Route::post('/product','ProductController@create');
Route::get('/product/{id}','ProductController@get');
Route::delete('/product/{id}', 'ProductController@delete');
Route::put('/product/{id}','ProductController@update');

Route::get('/currency','CurrencyController@all');
Route::get('/currency/{symbol}','CurrencyController@get');
