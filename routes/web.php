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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home/{data}', 'HomeController@sort')->name('home.sort');

Route::get('/client/{id}/admin', 'GroupeController@admin')->name('client.admin');

Route::post('/search', 'HomeController@search')->name('articles.search');

Route::get('/{id}', 'HomeController@show')->name('articles.show');

Route::post('/download', 'HomeController@download')->name('download.pdf');

Route::post('/groupes/store', 'SousGroupeController@store')->name('sousGroupes.store');

Route::get('/groupes/destroy/{id}', 'SousGroupeController@destroy')->name('sousGroupes.destroy');

Route::get('/users/all', 'UserController@all')->name('users.all');
Route::get('/users/create', 'UserController@create')->name('users.create');
Route::get('/users/{id}', 'UserController@show')->name('users.show');
Route::post('/users/update/{id}', 'UserController@update')->name('users.update');
Route::get('/users/destroy/{id}', 'UserController@destroy')->name('users.destroy');

Route::group(['middleware' => 'admin'], function () {
    Route::get('/themes/all', 'ThemeController@index')->name('themes.index');
    Route::get('/themes/create', 'ThemeController@create')->name('themes.create');
    Route::post('/themes/store', 'ThemeController@store')->name('themes.store');
    Route::get('/themes/{id}', 'ThemeController@show')->name('themes.show');
    Route::post('/themes/update/{id}', 'ThemeController@update')->name('themes.update');
    Route::get('/themes/destroy/{id}', 'ThemeController@destroy')->name('themes.destroy');
    });

Route::group(['middleware' => 'admin'], function () {
    Route::get('/clients/all', 'GroupeController@index')->name('groupes.index');
    Route::get('/clients/create', 'GroupeController@create')->name('groupes.create');
    Route::post('/clients/store', 'GroupeController@store')->name('groupes.store');
    Route::get('/clients/{id}', 'GroupeController@show')->name('groupes.show');
    Route::post('/clients/update/{id}', 'GroupeController@update')->name('groupes.update');
    Route::get('/clients/destroy/{id}', 'GroupeController@destroy')->name('groupes.destroy');
    });

Route::get('/admin/dashboard', 'AdminController@index')->name('admin.dashboard');

Route::get('/admin/themes', 'AdminController@theme')->name('admin.theme');

Route::get('/admin/indexing', 'AdminController@indexing')->name('admin.indexing');

Route::group(['middleware' => 'admin'], function () {
    Route::get('/newsletters/{id}', 'NewsletterController@index')->name('newsletters');
});

Route::get('test/index', 'TestController@index');

Route::get('home/expired', function () {
	return view('expire');
});
