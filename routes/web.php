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

Route::get('/', 'PagesController@index');
Route::get('/developers', 'PagesController@developers');
Route::get('/developer/create', 'PagesController@createDeveloper');
Route::post('/developer/create', 'DeveloperController@create');
Route::post('/developer/update', 'DeveloperController@update');
Route::post('/developer/delete', 'DeveloperController@delete');
Route::get('/teams', 'PagesController@teams');
