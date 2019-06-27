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

Route::get('/', 'PostController@index')->name('home');

/**
 * Post routes
 */
Route::resource('/posts', 'PostController', ['except' => ['show']]);
Route::get('/posts/{slug}', 'PostController@show')->where('slug', '[\w\d\-\_]+')->name('posts.show');

/**
 * Admin Routes
 */
Route::get('/admin', 'AdminController@index')->middleware(['auth', 'admin'])->name('admin');
