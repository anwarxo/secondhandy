<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/','ItemController@index');
Route::get('/search','ItemController@index');
Route::post('/search','ItemController@search');

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/contact', function () {
	return view('pages.contact');
});

Route::get('/items/{id}', 'ItemController@show');
Route::post('/items/{id}', 'ItemController@buy');
Route::post('/home', 'ItemController@delete');

Route::get('/add_item', 'ItemController@create');
Route::post('/add_item', 'ItemController@store');
Route::post('/add_detail_item', 'DetailItemController@store');
Route::post('/add_images', 'ImageController@store');




Route::group(['prefix' => 'admin'], function () {
	Route::get('/', function() {
    	return view('admin.index');
    });
	Route::get('/add_city', 'CityController@create');
	Route::post('/add_city', 'CityController@store');
	Route::get('/show_users', 'UserController@show_users');
	Route::post('/show_users', 'UserController@posting');
	Route::get('/add_category', 'CategoryController@create');
	Route::post('/add_category', 'CategoryController@store');
	Route::get('/add_detail', 'DetailController@create');
	Route::post('/add_detail', 'DetailController@store');
	Route::get('/connect_category_detail', 'CategoryDetailController@create');
	Route::post('/connect_category_detail', 'CategoryDetailController@store');
});