<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('Authentication.Login');
})->name('login');

Route::get('/register', function () {
    return "Registration Page Placeholder";
})->name('register');

Route::get('/password-reset', function () {
    return view('Authentication.forgot-password');
})->name('password.request');

Route::post('/password-email', function () {
    return "Password Reset Link Sent Placeholder";
})->name('password.email');

Route::post('/login', function () {
    return "Login POST Placeholder";
});



