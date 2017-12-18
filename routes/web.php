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

//  Route Auth
Route::get('/login', ['as' => 'login', 'uses' => 'HomeController@getLogin']);

Route::post('/login', ['uses' => 'HomeController@postLogin']);

Route::get('/logout', ['as' => 'logout', 'uses' => 'HomeController@logout']);
//  End Auth

Route::get('/', ['as' => 'index', 'uses' => 'HomeController@index']);

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/', ['as' => 'admin', 'uses' => 'DashboardController@index']);

    //  Route User
    Route::resource('/user', 'UserController');

    //  Route Slider
    Route::resource('/slider', 'SliderController');

    //  Route Category Product
    Route::resource('/cat-product', 'CatProductController');

    //  Route Product
    Route::resource('/product', 'ProductController');

    //  Route Product
    Route::resource('/cat-news', 'ProductController');

    //  Route Product
    Route::resource('/news', 'ProductController');

    //  Route Product
    Route::resource('/cat-image', 'ProductController');

    //  Route Product
    Route::resource('/image', 'ProductController');

    //  Route Product
    Route::resource('/project', 'ProductController');
});
