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

Route::prefix('/produto')->group(function () {
    Route::get('/list', '\Modules\Produto\Controllers\ProdutoController@list')->name('listProduto');
    Route::post('/create', '\Modules\Produto\Controllers\ProdutoController@create')->name('createProduto');
    Route::put('/update', '\Modules\Produto\Controllers\ProdutoController@update')->name('updateProduto');
    Route::delete('/delete', '\Modules\Produto\Controllers\ProdutoController@delete')->name('deleteProduto');
});

Route::prefix('/venda')->group(function () {
    Route::get('/list', '\Modules\Venda\Controllers\VendaController@list')->name('listVenda');
    Route::post('/create', '\Modules\Venda\Controllers\VendaController@create')->name('createVenda');
    Route::put('/update', '\Modules\Venda\Controllers\VendaController@update')->name('updateVenda');
    Route::delete('/delete', '\Modules\Venda\Controllers\VendaController@delete')->name('deleteVenda');
});




