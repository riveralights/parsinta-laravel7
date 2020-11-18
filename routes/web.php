<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController');

Route::get('post', 'PostController@index');
Route::get('post/{post:slug}', 'PostController@show')->name('post.show');

Route::view('contact', 'contact');
Route::view('about', 'about');
Route::view('login', 'login');
