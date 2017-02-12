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

Route::get('/', function () {
    return view('welcome');
});

#Route::resource('home','HomeController');

Route::group(['prefix'=>'home'],function(){
   Route::get('/','HomeController@floatingNavigationBar');
   Route::get('/index','HomeController@index');
   Route::get('/floatingNavigationBar','HomeController@floatingNavigationBar');
   Route::get('/fixedTheNavigationBar','HomeController@fixedTheNavigationBar');
   Route::get('/editBlog','HomeController@editBlog');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
