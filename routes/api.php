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
        Route::put('atualizar', 'UserController@update')->middleware('auth:api')->name('usuario.update');
        Route::post('login', 'UserController@login')->name('usuario.login');
        Route::post('seguir', 'UserController@toggleFriend')->name('usuario.seguir');
    });

    Route::prefix('conteudo')->middleware('auth:api')->group(function () {
        Route::post('salvar', 'ContentController@save')->name('content.save');
        Route::get('feed', 'ContentController@listByFriends')->name('content.list.by.friends');
        Route::get('user-content/{id}', 'ContentController@listByUser')->middleware('auth:api')->name('content.user.list');
        Route::post('toggle-like', 'ContentController@toggleLike')->name('content.toggle.like');
        Route::post('comment', 'ContentController@comment')->name('content.comment');
    });
});


