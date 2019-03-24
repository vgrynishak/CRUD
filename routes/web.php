<?php

/////*
////|--------------------------------------------------------------------------
////| Web Routes
////|--------------------------------------------------------------------------
////|
////| Here is where you can register web routes for your application. These
////| routes are loaded by the RouteServiceProvider within a group which
////| contains the "web" middleware group. Now create something great!
////|
//*/

Route::get('/', ['uses'=>'IndexController@public', 'as'=>'home']);
Route::get('/admin', ['uses'=>'IndexController@admin', 'as'=>'admin']);
Route::post('/login', ['uses'=>'IndexController@login', 'as'=>'login']);
Route::get('/logout', ['uses'=>'IndexController@logout', 'as'=>'logout']);
Route::get('/add', ['uses'=>'IndexController@add', 'as'=>'add']);
Route::post('/add_file', ['uses'=>'IndexController@add_file', 'as'=>'add']);
Route::get('/lists', ['uses'=>'IndexController@lists', 'as'=>'list']);
Route::post('/delete', ['uses'=>'IndexController@delete', 'as'=>'delet']);
Route::post('/show_doc', ['uses'=>'IndexController@show_doc', 'as'=>'show_doc']);
Route::post('/delete_file', ['uses'=>'IndexController@delete_file', 'as'=>'delet_file']);
Route::post('/update_doc', ['uses'=>'IndexController@update_doc', 'as'=>'update']);