<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AppSelectValidated;

Route::get('login', ['as' => 'login', 'uses' => 'App\Http\Controllers\Web\UserController@login']);
Route::get('/register', 'App\Http\Controllers\Web\UserController@register');

Route::middleware(['auth:sanctum', AppSelectValidated::class])->get('/', 'App\Http\Controllers\Web\UserController@dashboard');
Route::middleware(['auth:sanctum', AppSelectValidated::class])->get('/dashboard', 'App\Http\Controllers\Web\UserController@dashboard');

// Profile
Route::middleware(['auth:sanctum', AppSelectValidated::class])->get('/profile', 'App\Http\Controllers\Web\ClientController@profile');

// Assets
Route::middleware(['auth:sanctum', AppSelectValidated::class])->get('/assets', 'App\Http\Controllers\Web\AssetsController@list');
Route::middleware(['auth:sanctum', AppSelectValidated::class])->get('/assets/asset', 'App\Http\Controllers\Web\AssetsController@create');
Route::middleware(['auth:sanctum', AppSelectValidated::class])->get('/assets/asset/{id}', 'App\Http\Controllers\Web\AssetsController@edit');
Route::middleware(['auth:sanctum', AppSelectValidated::class])->get('/assets/fields', 'App\Http\Controllers\Web\AssetsController@fields');
Route::middleware(['auth:sanctum', AppSelectValidated::class])->get('/assets/categories', 'App\Http\Controllers\Web\AssetsController@categories');
Route::middleware(['auth:sanctum', AppSelectValidated::class])->get('/assets/events', 'App\Http\Controllers\Web\AssetsController@events');
Route::middleware(['auth:sanctum', AppSelectValidated::class])->get('/assets/alerts', 'App\Http\Controllers\Web\AssetsController@alerts');
Route::middleware(['auth:sanctum', AppSelectValidated::class])->get('/assets/responsables', 'App\Http\Controllers\Web\AssetsController@responsables');

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
Route::middleware(['auth:sanctum', AppSelectValidated::class])->post('user', 'App\Http\Controllers\Api\ClientController@addUser');
Route::middleware(['auth:sanctum', AppSelectValidated::class])->resource('assets/field', 'App\Http\Controllers\Api\FieldController');
Route::middleware(['auth:sanctum', AppSelectValidated::class])->resource('assets/category', 'App\Http\Controllers\Api\CategoryController');
Route::middleware(['auth:sanctum', AppSelectValidated::class])->resource('assets/assets', 'App\Http\Controllers\Api\AssetController');
Route::middleware(['auth:sanctum', AppSelectValidated::class])->resource('assets/event', 'App\Http\Controllers\Api\EventController');
Route::middleware(['auth:sanctum', AppSelectValidated::class])->resource('assets/alert', 'App\Http\Controllers\Api\AlertController');
Route::middleware(['auth:sanctum', AppSelectValidated::class])->resource('assets/responsable', 'App\Http\Controllers\Api\ResponsableController');
Route::middleware(['auth:sanctum', AppSelectValidated::class])->post('assets/search/asset', 'App\Http\Controllers\Api\AssetController@index');
Route::middleware(['auth:sanctum', AppSelectValidated::class])->post('assets/search/event', 'App\Http\Controllers\Api\EventController@index');
Route::middleware(['auth:sanctum', AppSelectValidated::class])->post('assets/search/alert', 'App\Http\Controllers\Api\AlertController@index');

/**
 * Upload System
 */
Route::middleware(['auth:sanctum'])->post('uploads', 'App\Http\Controllers\Api\FilemanagerController@upload');
Route::middleware(['auth:sanctum'])->get('uploads/{client}/{user}/{file}', 'App\Http\Controllers\Api\FilemanagerController@get');
