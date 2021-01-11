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

Route::resource('instituicaos', App\Http\Controllers\API\InstituicaoAPIController::class);


Route::resource('anuncios', App\Http\Controllers\API\AnuncioAPIController::class);

Route::resource('aulas', App\Http\Controllers\API\AulaAPIController::class);

Route::resource('disciplinas', App\Http\Controllers\API\DisciplinaAPIController::class);

Route::resource('disciplina__lecionas', App\Http\Controllers\API\Disciplina_LecionaAPIController::class);

Route::resource('tipos', App\Http\Controllers\API\TipoAPIController::class);

Route::resource('usuarios', App\Http\Controllers\API\UsuarioAPIController::class);