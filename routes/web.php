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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('posts/index', 'PostController@index')->name('posts.index');
Route::get('posts/create' , 'PostController@create')->name('posts.create');
Route::post('posts/store' ,'PostController@store')->name('posts.store');
Route::get('posts/edit/{id}','PostController@edit')->name('posts.edit');
Route::post('posts/update/{id}','PostController@update')->name('posts.update');
Route::post('posts/destroy/{id}', 'PostController@destroy')->name('posts.destroy');
