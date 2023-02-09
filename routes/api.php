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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rotas de autenticação
Route::get('/users', [App\Http\Controllers\AuthController::class, 'showUsers']);
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::Apiresource('cliente', 'App\Http\Controllers\ClienteController');
    Route::Apiresource('carro', 'App\Http\Controllers\CarroController');
    Route::Apiresource('locacao', 'App\Http\Controllers\LocacaoController');
    Route::Apiresource('marca', 'App\Http\Controllers\MarcaController');
    Route::Apiresource('modelo', 'App\Http\Controllers\ModeloController');
});
