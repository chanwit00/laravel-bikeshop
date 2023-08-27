<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\TypebookController;


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

Route::get('/book',[App\Http\Controllers\BookController::class, 'index']);
Route::post('/book/search',[App\Http\Controllers\BookController::class, 'search']);
Route::get('/book/search', 'BookController@search');
Route::get('/book/edit/{id?}', [BookController::class, 'edit']);
Route::post('/book/update', [BookController::class, 'update']);
Route::post('/book/insert', [BookController::class, 'insert']);
Route::get('/book/remove/{id?}', [BookController::class, 'remove']);


Route::get('/typebook',[App\Http\Controllers\TypebookController::class, 'index']);
Route::post('/typebook/search',[App\Http\Controllers\TypebookController::class, 'search']);
Route::get('/typebook/edit/{id?}', [TypebookController::class, 'edit']);
Route::post('/typebook/update', [TypebookController::class, 'update']);
Route::post('/typebook/insert', [TypebookController::class, 'insert']);
Route::get('/typebook/remove/{id?}', [TypebookController::class, 'remove']);