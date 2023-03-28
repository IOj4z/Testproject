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
//    'middleware' => ['auth:api', 'scope:admin'],
    'prefix' => 'admin',
    'namespace' => 'API\V1\SUPER_USER'
], function () {
    Route::apiResource('users', 'UserController');
});

//Route::apiResource('driver', App\Http\Controllers\API\V1\USER\UserController::class,['index'])->only('index', 'show');
Route::group([
//    'middleware' => ['auth:api', 'scope:drivers'],
    'prefix' => 'drivers',
    'namespace' => 'API\V1\USER'
], function () {
    Route::apiResource('user', 'UserController')->only('index', 'show');
});
