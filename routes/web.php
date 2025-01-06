<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\ClientController;

Route::get('login', ['as' => 'login', 'uses' => 'App\Http\Controllers\Web\UserController@login']);
Route::get('/register', 'App\Http\Controllers\Web\UserController@register');

Route::get('/profile', 'App\Http\Controllers\Web\ClientController@profile');
Route::get('/ativos/ativos', 'App\Http\Controllers\Web\AtivosController@ativos');
Route::get('/ativos/register', 'App\Http\Controllers\Web\AtivosController@register');
Route::get('/ativos/alerts', 'App\Http\Controllers\Web\AtivosController@alerts');
Route::get('/ativos/inventory', 'App\Http\Controllers\Web\AtivosController@inventory');
Route::get('/ativos/history', 'App\Http\Controllers\Web\AtivosController@history');
Route::get('/ativos/edit', 'App\Http\Controllers\Web\AtivosController@edit');
Route::middleware(['auth:sanctum'])->get('/', 'App\Http\Controllers\Web\UserController@dashboard');
Route::middleware(['auth:sanctum'])->get('/dashboard', 'App\Http\Controllers\Web\UserController@dashboard');

Route::middleware(['auth:sanctum'])->get('/profile', 'App\Http\Controllers\Web\ClientController@profile');
Route::middleware(['auth:sanctum'])->get('/ativos/ativos', 'App\Http\Controllers\Web\AtivosController@ativos');
Route::middleware(['auth:sanctum'])->get('/ativos/register', 'App\Http\Controllers\Web\AtivosController@register');
Route::middleware(['auth:sanctum'])->get('/ativos/alerts', 'App\Http\Controllers\Web\AtivosController@alerts');
Route::middleware(['auth:sanctum'])->get('/ativos/inventory', 'App\Http\Controllers\Web\AtivosController@inventory');
Route::middleware(['auth:sanctum'])->get('/ativos/history', 'App\Http\Controllers\Web\AtivosController@history');
Route::middleware(['auth:sanctum'])->get('/ativos/edit', 'App\Http\Controllers\Web\AtivosController@edit');

/**
 * Admin
 */
Route::middleware(['auth:sanctum'])->get('/admin', 'App\Http\Controllers\Web\AdminController@admin');

/**
 * Requests
 */
Route::post('login', 'App\Http\Controllers\Api\AuthController@login');
Route::resource('client', 'App\Http\Controllers\Api\ClientController');

Route::get ('client', [ClientController::class, 'info']);