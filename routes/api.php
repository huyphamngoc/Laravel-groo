<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
//Auth::routes(['vetify' => true]);

Route::post('login', 'Api\UserController@login');
Route::post('register', 'Api\UserController@register');

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('details', 'Api\UserController@details');
});
