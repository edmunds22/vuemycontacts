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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/api/list', 'ContactsController@list');
Route::get('/api/fetch/{id}', 'ContactsController@fetch');
Route::post('/api/create', 'ContactsController@create');
Route::post('/api/update/{id}', 'ContactsController@update');
Route::post('/api/register', 'RegisterController@register');
Route::post('/api/login', 'RegisterController@login');