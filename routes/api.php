<?php

use Illuminate\Http\Request;
// use Illuminate\Routing\Route;
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

Route::post('login', 'UserController@login');

//Routes for user
Route::get('/users', 'UserController@index');
Route::post('/addUser', 'UserController@addUser');
Route::delete('/user/{id}', 'UserController@deleteUserbyID');
Route::post('/user/{id}', 'UserController@editUserbyID');
Route::post('/userUpdatePassword/{id}', 'UserController@loginUserChangePass');


Route::middleware('auth:api')->group(function () {
});
