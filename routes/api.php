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

Route::prefix('/autor')->group(function () {
    Route::get('/list', '\Modules\Autor\Controllers\AutorController@list')->name('listAutor');
    Route::post('/create', '\Modules\Autor\Controllers\AutorController@create')->name('createAutor');
    Route::put('/update', '\Modules\Autor\Controllers\AutorController@update')->name('updateAutor');
    Route::delete('/delete', '\Modules\Autor\Controllers\AutorController@delete')->name('deleteAutor');
});




