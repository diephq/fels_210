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

Route::get('/', 'HomeController@index');

Route::auth();

Route::group(['middleware' => 'auth'], function () {

    Route::get('/user/{id}', [
        'as' => 'profile',
        'uses' => 'UserController@edit'
    ]);

    Route::post('/user/{id}', [
        'as' => 'update_profile',
        'uses' => 'UserController@update'
    ]);

    Route::get('categories', [
        'as' => 'categories',
        'uses' => 'CategoryController@index'
    ]);

    Route::get('category/{id}', [
        'as' => 'category_detail',
        'uses' => 'CategoryController@show'
    ]);

    Route::post('lesson/create', [
        'as' => 'lesson_create',
        'uses' => "LessonController@store"
    ]);

    Route::get('category/{id}/lesson/{lessonId}', [
        'as' => 'lesson',
        'uses' => 'LessonController@show'
    ]);

    Route::post('category/{id}/lesson/{lessonId}', [
        'as' => 'answer',
        'uses' => "LessonController@answer"
    ]);
});
