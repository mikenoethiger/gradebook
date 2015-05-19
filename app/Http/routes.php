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


Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'active_school'], function () {

        Route::group(['middleware' => 'active_semester'], function() {
            Route::get('/dashboard', 'HomeController@dashboard');

            Route::resource('/subject', 'SubjectController');
            Route::post('/subject/restore/{id}', 'SubjectController@restore');

            Route::resource('/grade', 'GradeController');
            Route::post('/grade/restore/{grade}', 'GradeController@restore');

            Route::resource('/exam', 'ExamController');
        });

        Route::resource('/semester', 'SemesterController');
        Route::put('/semester/change/{semester}', 'SemesterController@change');
    });
    Route::resource('/school', 'SchoolController');
    Route::get('/school/change/{school}', 'SchoolController@change');
});

Route::get('/', 'PublicController@landing');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);