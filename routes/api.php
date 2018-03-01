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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('url_items', 'ShortenerController@index');
Route::get('url_items/{id}', 'ShortenerController@show');
Route::post('url_items', 'ShortenerController@store');
Route::put('url_items/{id}', 'ShortenerController@update');
Route::delete('url_items/{id}', 'ShortenerController@delete');