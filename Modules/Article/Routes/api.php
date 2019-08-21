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

Route::middleware('auth:api')->prefix('articles')->group(function() {
  Route::get('/', 'ArticlesController@index');
  Route::post('/', 'ArticlesController@load');
  Route::post('/default', 'ArticlesController@create');
  Route::delete('/', 'ArticlesController@delete');
  Route::patch('/', 'ArticlesController@save');
});


Route::middleware('auth:api')->prefix('article_types')->group(function() {
  Route::get('/', 'ArticleTypeController@index');
  Route::post('/', 'ArticleTypeController@load');
  Route::post('/default', 'ArticleTypeController@create');
  Route::delete('/', 'ArticleTypeController@delete');
  Route::patch('/', 'ArticleTypeController@save');
});