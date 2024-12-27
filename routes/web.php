<?php

use Illuminate\Support\Facades\Route;




Route::get('/', 'App\Http\Controllers\Web\UserController@login');
Route::get('/login', 'App\Http\Controllers\Web\UserController@login');
Route::get('/register', 'App\Http\Controllers\Web\UserController@register');

Route::get('/profile', 'App\Http\Controllers\Web\ClientController@profile');
Route::get('/ativos/ativos', 'App\Http\Controllers\Web\AtivosController@ativos');
Route::get('/ativos/register', 'App\Http\Controllers\Web\AtivosController@register');
Route::get('/ativos/alerts', 'App\Http\Controllers\Web\AtivosController@alerts');
Route::get('/ativos/inventory', 'App\Http\Controllers\Web\AtivosController@register');
Route::get('/ativos/history', 'App\Http\Controllers\Web\AtivosController@history');
Route::get('/ativos/edit', 'App\Http\Controllers\Web\AtivosController@edit');

//Route::middleware(['auth:sanctum'])->post('/pusher/auth', 'App\Http\Controllers\Web\PageController@pusher');