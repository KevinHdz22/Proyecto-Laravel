<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('login', 'App\Http\Controllers\ApiController@login');

Route::middleware(['jwt'])->group(function () {
    Route::post('create', 'App\Http\Controllers\ApiController@create');
    Route::get('read/{id}', 'App\Http\Controllers\ApiController@read');
    Route::put('update', 'App\Http\Controllers\ApiController@update')->name('actualizar-usuario');
    Route::delete('delete', 'App\Http\Controllers\ApiController@delete');

});

Route::get('/user-list', 'App\Http\Controllers\UserController@showUserList')->name('user-list');
Route::delete('/eliminar-usuario/{id}', 'App\Http\Controllers\UserController@delete')->name('eliminar-usuario');

Route::get('/editar-usuario/{id}', 'App\Http\Controllers\UserController@edit')->name('editar-usuario');
Route::put('/actualizar-usuario/{id}', 'App\Http\Controllers\UserController@update')->name('actualizar-usuario');

Route::get('/crear-usuario', 'App\Http\Controllers\UserController@create')->name('crear-usuario');
Route::post('/almacenar-usuario', 'App\Http\Controllers\UserController@store')->name('almacenar-usuario');












