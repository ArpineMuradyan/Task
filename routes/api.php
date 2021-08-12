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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('customauth')->get('/authenticated', function () {
    return response(true);
});
Route::post('register', 'App\Http\Controllers\AuthController@register');
Route::post('login', 'App\Http\Controllers\AuthController@login');
Route::post('logout', 'App\Http\Controllers\AuthController@logout');
Route::get('getUsersInfo', 'App\Http\Controllers\UserController@getUsersInfo');
Route::get('getUsers', 'App\Http\Controllers\UserController@getUser');
Route::post('saveTask', 'App\Http\Controllers\TaskController@saveTask');
Route::get('getTask', 'App\Http\Controllers\TaskController@getTask');
Route::post('changeStatus', 'App\Http\Controllers\TaskController@changeStatus');
