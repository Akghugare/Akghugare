<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/','App\Http\Controllers\LoginController@index')->name('/');
Route::post('loginAction','App\Http\Controllers\LoginController@login_action')->name('loginAction');
Route::get('/registration','App\Http\Controllers\LoginController@registration_list')->name('registration');
Route::post('/registerAction','App\Http\Controllers\LoginController@registration_action')->name('registerAction');
Route::post('/getStates','App\Http\Controllers\LoginController@get_states')->name('getStates');
Route::post('/getCities','App\Http\Controllers\LoginController@get_cities')->name('getCities');
Route::get('/Dashboard','App\Http\Controllers\LoginController@dashboard')->name('Dashboard');
Route::get('/logout_action','App\Http\Controllers\LoginController@logout')->name('logout_action');
