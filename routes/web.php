<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('user.dashboard');
});

Route::get('/search', function () {
    return view('user.search_result');
});

Route::get('/admin', function () {
    return view('admin.admin');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/dashadm', function () {
    return view('admin.dashboard');
});

Route::get('/profadm', function () {
    return view('admin.profile');
});