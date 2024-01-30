<?php

use Illuminate\Support\Facades\Route;

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

Route::view('/', 'welcome');

Route::prefix('/produto')->group(function () {
    Route::get('/', '\Modules\Produto\Controllers\ProdutoController@index')->name('indexProduto');
    Route::view('/cadastrar', 'Produto/manter')->name('cadastrarProduto');
    Route::get('/editar/{id?}','\Modules\Produto\Controllers\ProdutoController@edit')->name('editarProduto');
});




