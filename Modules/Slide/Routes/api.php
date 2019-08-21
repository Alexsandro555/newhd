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

Route::middleware('auth:api')->prefix('slides')->group(function() {
  Route::get('/', 'SlideController@index');
  Route::post('/', 'SlideController@load');
  Route::post('/default', 'SlideController@create');
  Route::delete('/', 'SlideController@delete');
  Route::patch('/', 'SlideController@save');
});