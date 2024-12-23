<?php

use Illuminate\Support\Facades\Route;




Route::get('/', 'App\Http\Controllers\Web\UserController@login');
Route::get('/login', 'App\Http\Controllers\Web\UserController@login');
Route::get('/register', 'App\Http\Controllers\Web\UserController@register');

Route::get('/profile', 'App\Http\Controllers\Web\ClientController@profile');


//Route::middleware(['auth:sanctum'])->post('/pusher/auth', 'App\Http\Controllers\Web\PageController@pusher');