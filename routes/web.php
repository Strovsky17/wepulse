<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AppSelectValidated;

Route::get('login', ['as' => 'login', 'uses' => 'App\Http\Controllers\Web\UserController@login']);
Route::get('/register', 'App\Http\Controllers\Web\UserController@register');

/*
Route::get('/ativos/ativos', 'App\Http\Controllers\Web\AtivosController@ativos');
Route::get('/ativos/register', 'App\Http\Controllers\Web\AtivosController@register');
Route::get('/ativos/alerts', 'App\Http\Controllers\Web\AtivosController@alerts');
Route::get('/ativos/inventory', 'App\Http\Controllers\Web\AtivosController@inventory');
Route::get('/ativos/history', 'App\Http\Controllers\Web\AtivosController@history');
Route::get('/ativos/edit', 'App\Http\Controllers\Web\AtivosController@edit');*/


Route::middleware(['auth:sanctum', AppSelectValidated::class])->get('/', 'App\Http\Controllers\Web\UserController@dashboard');
Route::middleware(['auth:sanctum', AppSelectValidated::class])->get('/dashboard', 'App\Http\Controllers\Web\UserController@dashboard');

Route::middleware(['auth:sanctum', AppSelectValidated::class])->get('/profile', 'App\Http\Controllers\Web\ClientController@profile');

/*Route::middleware(['auth:sanctum', AppSelectValidated::class])->get('/ativos/ativos', 'App\Http\Controllers\Web\AtivosController@ativos');
Route::middleware(['auth:sanctum', AppSelectValidated::class])->get('/ativos/register', 'App\Http\Controllers\Web\AtivosController@register');
Route::middleware(['auth:sanctum', AppSelectValidated::class])->get('/ativos/alerts', 'App\Http\Controllers\Web\AtivosController@alerts');
Route::middleware(['auth:sanctum', AppSelectValidated::class])->get('/ativos/inventory', 'App\Http\Controllers\Web\AtivosController@inventory');
Route::middleware(['auth:sanctum', AppSelectValidated::class])->get('/ativos/history', 'App\Http\Controllers\Web\AtivosController@history');
Route::middleware(['auth:sanctum', AppSelectValidated::class])->get('/ativos/edit', 'App\Http\Controllers\Web\AtivosController@edit');*/

/**
 * Admin
 */
Route::middleware(['auth:sanctum'])->get('/admin', 'App\Http\Controllers\Web\AdminController@admin');
Route::middleware(['auth:sanctum'])->get('/admin/migrate', 'App\Http\Controllers\Web\AdminController@migrate');

/**
 * Requests
 */
Route::post('login', 'App\Http\Controllers\Api\AuthController@login');

Route::middleware(['auth:sanctum'])->resource('client', 'App\Http\Controllers\Api\ClientController');
Route::middleware(['auth:sanctum'])->post('client/change', 'App\Http\Controllers\Api\ClientController@change');
Route::middleware(['auth:sanctum', AppSelectValidated::class])->post('profile', 'App\Http\Controllers\Api\ClientController@profile');
