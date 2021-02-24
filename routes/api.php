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
Route::middleware('auth:sanctum')->get('/athenticated', function () {
    return true;
});
Route::post('register', 'RegisterController@register');
Route::post('login', 'LoginController@login');
Route::post('logout', 'LoginController@logout');


Route::get('users', 'UsersController@index');
Route::group(['prefix' => 'users'], function () {
    Route::get('edit/{id}', 'UsersController@edit');
    Route::post('update/{id}', 'UsersController@update');
    Route::delete('delete/{id}', 'UsersController@delete');
});