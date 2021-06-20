<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//API routes for user access
Route::group([] , function (){
    Route::post('/login', 'AuthController@login');

    Route::post('/register', 'AuthController@register');

    Route::middleware('auth:api')->post('/logout', 'AuthController@logout');

    Route::middleware('auth:api')->get('/user', 'AuthController@current');
});

//API routes for book management
Route::middleware('auth:api')->prefix('book')->group(function (){

    Route::get('/', 'BookController@index');

    Route::get('/create', 'BookController@create');
    Route::post('/create', 'BookController@create');

    Route::patch('edit/{bookId}', 'BookController@edit');

    Route::delete('delete/{bookId}', 'BookController@delete');

    Route::get("/history/{userId}", 'BookController@history');

    Route::post("/rating/{bookId}", 'BookController@rating');
});

//API routes for book management by Admin
Route::middleware(['auth:api', 'is_admin'])->post('/admin/user', 'Admin\UserController@create');

Route::middleware(['auth:api', 'is_admin'])->prefix('admin/book')->group(function (){

    Route::get('/', 'Admin\BookController@index');

    Route::post('/create', 'Admin\BookController@create');

    Route::patch('edit/{bookId}', 'Admin\BookController@edit');

    Route::delete('delete/{bookId}', 'Admin\BookController@delete');

    Route::get("/history", 'Admin\BookController@history');

    Route::post("/rating/{bookId}", 'BookController@rating');

    Route::get("/validation", 'Admin\StockController@validation');

    Route::post("/stock/{bookId}", 'Admin\StockController@stock');
});
