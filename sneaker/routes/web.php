<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShoeController;
use App\Http\Controllers\ฺBrandController;


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
    return view('layouts.master');
});


Route::get('/shoe',[App\Http\Controllers\ShoeController::class, 'index']);
Route::post('/shoe/search',[App\Http\Controllers\ShoeController::class, 'search']);
Route::get('/shoe/search', 'ShoeController@search');
Route::get('/shoe/edit/{id?}', [ShoeController::class, 'edit']);
Route::post('/shoe/update', [ShoeController::class, 'update']);
Route::post('/shoe/insert', [ShoeController::class, 'insert']);
Route::get('/shoe/remove/{id?}', [ShoeController::class, 'remove']);

Route::get('/brand',[App\Http\Controllers\BrandController::class, 'index']);
Route::post('/brand/search',[App\Http\Controllers\BrandController::class, 'search']);
Route::get('/brand/edit/{id?}', [App\Http\Controllers\BrandController::class, 'edit']);
Route::post('/brand/update', [App\Http\Controllers\BrandController::class, 'update']);
Route::post('/brand/insert', [App\Http\Controllers\BrandController::class, 'insert']);
Route::get('/brand/remove/{id?}', [App\Http\Controllers\BrandController::class, 'remove']);