<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/admin/db', function () {
    return view('admin-db');
});

Route::get('/admin/dashboard', function () {
    return view('admin-dashboard');
});

Route::get('/user/dashboard', function () {
    return view('user-dashboard');
});

Route::get('/eval', function () {
    return view('eval-form');
});


Route::get('/eval', function () {
    return view('eval-form');
});


