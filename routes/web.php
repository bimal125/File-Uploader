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

Route::get('/','FileController@create');
Route::post('file','FileController@store');
Route::get('/download/{url}','FileController@download');

Route::get('/upload','UploadController@index');

Route::any('/fine-upload','UploadController@upload');