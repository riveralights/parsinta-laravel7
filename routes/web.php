<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $name = "<i>Alica Putri A</i>";
    $postBody = "Lorem ipsum dolor sir amet dimana ada makanan disitu adalah saya";
    return view('welcome', ['name' => $name, 'body' => $postBody]);
});
Route::view('contact', 'contact');
Route::view('series/create', 'series.create');
Route::view('series/premium', 'series.premium.index');
