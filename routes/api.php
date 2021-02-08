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

Route::resource('instituicao', App\Http\Controllers\API\InstituicaoAPIController::class);


Route::resource('anuncio', App\Http\Controllers\API\AnuncioAPIController::class);

Route::resource('aula', App\Http\Controllers\API\AulaAPIController::class);

Route::resource('disciplina', App\Http\Controllers\API\DisciplinaAPIController::class);

Route::resource('disciplina__leciona', App\Http\Controllers\API\Disciplina_LecionaAPIController::class);

Route::resource('tipo', App\Http\Controllers\API\TipoAPIController::class);

Route::resource('usuario', App\Http\Controllers\API\UsuarioAPIController::class);
