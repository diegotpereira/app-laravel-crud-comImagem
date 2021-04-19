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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ver-estudantes', 'EstudanteController@ver');
Route::get('/add-estudante', function(){return view('add-estudante');});
Route::post('/upload-pp', 'EstudanteController@upload_pp');
Route::post('/salvar-estudante', 'EstudanteController@store');
Route::get('/editar-estudante/{id}', 'EstudanteController@editar');
Route::post('/atualizar-estudante', 'EstudanteController@atualizar');
Route::get('/deletar-estudante/{id}', 'EstudanteController@deletar');
