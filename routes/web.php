<?php

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
Route::group(['namespace' => 'Site'], function(){
Route::get('/', 'SiteController@index')->name('home');
Route::get('/tests', 'ClientesController@tests');
Route::resource('/endereco', 'EnderecoController');
Route::resource('/clientes', 'ClientesController');
Route::get('/devedores/{devedores?}', 'ClientesController@index');
Route::resource('/avulso', 'AvulsoController');
Route::resource('/carros', 'CarrosController');
Route::resource('/marcas', 'MarcasController');
Route::resource('/precos', 'TabelaPrecoController');
Route::resource('/preco', 'PrecoController');
});
