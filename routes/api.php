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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('API')->group(function () {

    // Rotas Usuários

    Route::prefix('usuario')->group(function () {
        Route::post('salvar', 'UserController@store')->name('usuario.salvar');
        Route::put('atualizar', 'UserController@update')->name('usuario.update');
        Route::post('login', 'UserController@login')->name('usuario.login');
    });


});


