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
Route::middleware('auth:api')->group(function () {
    Route::get('/users', 'UserController@index');
    Route::post('/addUser', 'UserController@addUser');
    Route::delete('/user/{id}', 'UserController@deleteUserbyID');
    Route::post('/user/{id}', 'UserController@editUserbyID');
    Route::post('/userUpdatePassword/{id}', 'UserController@loginUserChangePass');


    //Routes for Track
    Route::get('/tracks', 'TrackController@index');
    Route::get('/track/{id}', 'TrackController@getTrack');
    Route::post('/addTrack', 'TrackController@addTrack');
    Route::delete('/track/{id}', 'TrackController@deleteTrackbyID');
    Route::post('/track/{id}', 'TrackController@editTrackbyID');

    //Routes for Strand
    Route::get('/strands', 'StrandController@index');
    Route::post('/addStrand', 'StrandController@addStrand');
    Route::delete('/strand/{id}', 'StrandController@deleteStrandbyID');
    Route::post('/strand/{id}', 'StrandController@editStrandbyID');

    //Routes for Enrollment
    Route::get('enrollments/options', 'EnrollmentController@options');

    Route::get('/enrollments', 'EnrollmentController@index');
    Route::get('/enrollments/{id}', 'EnrollmentController@show');
    Route::post('/enrollments', 'EnrollmentController@store');
    Route::post('/enrollments/{id}', 'EnrollmentController@editStudentnyID');
    Route::delete('/enrollments/{id}', 'EnrollmentController@destroy');

    Route::get('/reports/enrollments', 'ReportController@enrollmentReports');
    Route::get('/reports/daily', 'ReportController@getDailyReport');
    Route::get('/reports/options', 'ReportController@options');
});
