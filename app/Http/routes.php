<?php

Route::get('/', [
	'uses' => 'HomeController@home'
	]);

Route::get('/importar-arquivo', [
	'uses' => 'HomeController@importar_arquivo'
	]);

Route::post('/import_arquivo', [
	'uses' => 'HomeController@import_arquivo'
	]);

Route::get('/veiculo', [
	'uses' => 'HomeController@veiculo'
	]);

Route::get('/adiciona-veiculo', [
	'uses' => 'HomeController@adiciona_veiculo'
	]);

Route::post('/add_veiculo', [
	'uses' => 'HomeController@add_veiculo'
	]);

Route::get('/editar-veiculo/{id}', [
	'uses' => 'HomeController@editar_veiculo'
	]);

Route::post('/att_veiculo/{id}', [
	'uses' => 'HomeController@att_veiculo'
	]);

Route::get('/relatorios', [
	'uses' => 'HomeController@relatorios'
	]);

Route::get('/dados-relatorio', [
	'uses' => 'HomeController@dados_relatorio'
	]);

Route::get('/arquivos-importados', [
	'uses' => 'HomeController@arquivos_importados'
	]);

Route::get('/visualizar-dados-teste/{id}', [
	'uses' => 'HomeController@visualizar_dados_teste'
	]);

Route::get('datatable/getposts', 
	['as'=>'datatable.getposts',
	'uses'=>'HomeController@getPosts']);

Route::get('/deletar-item-arquivo/{id}', [
	'uses' => 'HomeController@deletar_item_arquivo'
	]);

Route::get('/deletar-dados-teste/{id}', [
	'uses' => 'HomeController@deletar_dados_teste'
	]);

Route::get('/deletar-veiculo/{id}', [
	'uses' => 'HomeController@deletar_veiculo'
	]);