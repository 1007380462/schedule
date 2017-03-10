<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['prefix' => 'blog'], function () {
    Route::get('/','IndexController@floatingNavigationBar');
    Route::get('/index','IndexController@index');
    Route::get('/floatingNavigationBar','IndexController@floatingNavigationBar');
    Route::get('/fixedTheNavigationBar','IndexController@fixedTheNavigationBar');
    Route::get('/editBlog','IndexController@editBlog');
    Route::post('/storeBlog','IndexController@storeBlog');
    Route::get('/showBlogList','IndexController@showBlogList');
    Route::get('/createBlog','IndexController@createBlog');
    Route::post('/getBlogContent','IndexController@getBlogContent');
    Route::get('/createDirectory','IndexController@createDirectory');
    Route::post('/storeDirectory','IndexController@storeDirectory');
    Route::post('/adjustNodePlace','IndexController@adjustNodePlace');

    Route::get('/schedule','ScheduleController@schedule');
    Route::post('/addSchedule','ScheduleController@addSchedule');
    Route::post('/editSchedule','ScheduleController@editSchedule');
    Route::post('/modifyDuration','ScheduleController@modifyDuration');
    Route::post('/removeSchedule','ScheduleController@removeSchedule');
    Route::post('/moveEvent','ScheduleController@moveEvent');
});
