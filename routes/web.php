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

// hago el require pero de ahora con use

Route::get('/', function () {

    return view('welcome');
});

// Rutas Generales
Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Rutas Usuario
Route::get('/config', 'App\Http\Controllers\UserController@config')->name('config');
Route::post('/user/update', 'App\Http\Controllers\UserController@update')->name('user.update');
Route::get('/user/avatar/{filename}', 'App\Http\Controllers\UserController@getImage')->name('user.avatar');
Route::get('/user/profile/{id}', 'App\Http\Controllers\UserController@profile')->name('user.profile');
Route::get('/user/people/{search?}', 'App\Http\Controllers\UserController@index')->name('user.index');

// Rutas Imagen
Route::get('/upload-image', 'App\Http\Controllers\ImageController@create')->name('image.create');
Route::post('/image/save', 'App\Http\Controllers\ImageController@save')->name('image.save');
Route::get('/image/file/{filename}', 'App\Http\Controllers\ImageController@getImage')->name('image.file');
Route::get('/image/detail/{id}', 'App\Http\Controllers\ImageController@detail')->name('image.detail');
Route::get('/image/delete/{id}', 'App\Http\Controllers\ImageController@delete')->name('image.delete');
Route::get('/image/edit/{id}', 'App\Http\Controllers\ImageController@edit')->name('image.edit');
Route::post('/image/update', 'App\Http\Controllers\ImageController@update')->name('image.update');

// Rutas Like
Route::get('/like/{image_id}', 'App\Http\Controllers\LikeController@like')->name('like.save');
Route::get('/dislike/{image_id}', 'App\Http\Controllers\LikeController@dislike')->name('like.delete');
Route::get('/likes', 'App\Http\Controllers\LikeController@index')->name('like.index');

// Rutas Comment
Route::post('/comment/save', 'App\Http\Controllers\CommentsController@save')->name('comment.save');
Route::get('/comment/delete/{id}', 'App\Http\Controllers\CommentsController@delete')->name('comment.delete');










