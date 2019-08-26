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

Route::get('/', ['uses' => 'SiteController@index', 'as' => 'main']);
Route::get('/slides', 'SiteController@slides');
Route::get('/admin', ['uses' => '\Modules\Auth\Http\Controllers\AdminController@index', 'as' => 'master']);
Route::get('/faq.php', '\Modules\Page\Http\Controllers\PagesController@faq');
Route::get('/contacts.html', '\Modules\Page\Http\Controllers\PagesController@contracts');
Route::get('/{slug}.html', '\Modules\Article\Http\Controllers\ArticleController@show');