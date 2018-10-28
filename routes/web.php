<?php

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

Route::get('/', 'DownloadController@show')->name('main');
Route::get('/list', 'DownloadController@downloadList');
Route::get('/get/{id}', 'DownloadController@get');

Route::post('/', 'DownloadController@store');
