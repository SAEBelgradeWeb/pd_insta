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


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::post('/posts', 'PostsController@store')->middleware('auth');
Route::post('/comments', 'CommentsController@store')->middleware('auth');

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

