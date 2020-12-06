<?php

use Illuminate\Support\Facades\Route;

Route::get('post', 'PostController@index')->name('post.index');

Route::prefix('post')->middleware(['auth'])->group(function () {
  Route::get('create', 'PostController@create')->name('post.create');
  Route::post('create', 'PostController@store')->name('post.store');
  Route::get('{post:slug}/edit', 'PostController@edit')->name('post.edit');
  Route::patch('{post:slug}/edit', 'PostController@update')->name('post.update');
  Route::delete('{post:slug}/delete', 'PostController@destroy')->name('post.destroy');
});
Route::get('post/{post:slug}', 'PostController@show')->name('post.show')->withoutMiddleware('auth');



Route::get('categories/{category:slug}', 'CategoryController@show')->name('categories.show');

Route::get('tags/{tag:slug}', 'TagController@show')->name('tags.show');

Route::view('contact', 'contact');
Route::view('about', 'about');
Route::view('login', 'login');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
