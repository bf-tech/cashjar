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

Route::get('/', function () {
    return view('welcome');
});

Route::get('home', [
    'middleware' => 'auth',
    'uses' => 'HomeController@index'
]);

Route::get('readme', function () {
    return view('welcome');
});

Route::resource('groupevent', 'GroupeventController');
Route::get('groupevent/join/{groupevent_id}', 'GroupeventController@join');
Route::get('groupevent/leave/{groupevent_id}', 'GroupeventController@leave');

Route::resource('expense', 'ExpenseController');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
