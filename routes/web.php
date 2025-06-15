<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/register', function () {
    return view('/auth/register');
})->name('register.form');
Route::get('/login', function () {
    return view('/auth/login');
})->name('login.form');

Route::get('/', function () {
    return view('home');
})->name('home');
Route::get('/home', function () {
    return redirect()->route('home');
});
Route::get('/admin', function () {
    return view('admin');
});