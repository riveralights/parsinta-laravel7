<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController');

Route::get('post', 'PostController@index')->name('post.index');

Route::get('post/create', 'PostController@create')->name('post.create');
Route::post('post/create', 'PostController@store')->name('post.store');

Route::get('post/{post:slug}/edit', 'PostController@edit')->name('post.edit');
Route::patch('post/{post:slug}/edit', 'PostController@update')->name('post.update');

Route::get('post/{post:slug}', 'PostController@show')->name('post.show');

Route::delete('post/{post:slug}/delete', 'PostController@destroy')->name('post.destroy');

Route::get('categories/{category:slug}', 'CategoryController@show');

Route::view('contact', 'contact');
Route::view('about', 'about');
Route::view('login', 'login');
