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

Route::prefix('v1')->group(function () {
    Route::post('login', 'Api\AuthController@login');
    Route::post('register', 'Api\AuthController@register');
    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('getUser', 'Api\AuthController@getUser');
    });
    Route::post('updateUser/{id}', 'Api\AuthController@updateUser');
    Route::resource('events', 'EventController');
    Route::resource('myevents', 'EventStatusController');
    Route::resource('admin', 'AdminController');
    Route::post('updateEvent/{id}', 'AdminController@updateEvent');
    Route::get('dashboard/{id}', 'EventController@index');
});
