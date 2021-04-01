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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('template');
})->middleware(['auth']);

Route::middleware(['auth'])->prefix('usuarios')->group(function(){
    Route::get('/', 'UsersController@index');
    Route::get('buscar', 'UsersController@search');
    Route::get('mostrar/{id}', 'UsersController@show');
    Route::get('crear', 'UsersController@create');
    Route::post('guardar', 'UsersController@store');
    Route::get('editar/{id}', 'UsersController@edit');
    Route::post('actualizar/{id}', 'UsersController@update');
    Route::post('eliminar', 'Userscontroller@destroy');
});

Route::prefix('posts')->group(function(){
    Route::get('/', 'PostsController@index');
    Route::get('buscar', 'PostsController@search');
    Route::get('mostrar/{id}', 'PostsController@show');
    Route::get('crear', 'PostsController@create');
    Route::post('guardar', 'PostsController@store');
    Route::get('editar/{id}', 'PostsController@edit');
    Route::post('actualizar/{id}', 'PostsController@update');
    Route::post('eliminar', 'Postscontroller@destroy');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
