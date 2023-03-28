<?php

use Illuminate\Http\Request;
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
Route::post('login', 'AuthController@login');
Route::group([
    'middleware' => ['auth:api', 'scope:admin'],
    'prefix' => 'admin',
    'namespace' => 'API\V1\SUPER_USER'
], function () {
    Route::apiResource('users', 'UserController');
    Route::post('upload','ImageController@upload');
});


Route::group([
    'middleware' => ['auth:api', 'scope:driver'],
    'prefix' => 'driver',
], function () {
    Route::get('user', 'AuthController@user');
    Route::put('users/info', 'AuthController@updateInfo');
    Route::put('users/password', 'AuthController@updatePassword');
    Route::post('logout', 'AuthController@logout');
});

/*Route::group([
//    'middleware' => ['auth:api', 'scope:drivers'],
    'prefix' => 'drivers',
    'namespace' => 'API\V1\USER'
], function () {
    Route::get('user', 'AuthController@user');
    Route::put('users/info', 'AuthController@updateInfo');
    Route::put('users/password', 'AuthController@updatePassword');
    Route::post('logout', 'AuthController@logout');
});*/
