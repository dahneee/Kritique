<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\QuestionnaireController;

Route::get('/', function () {
    return view('login');
});

Route::get('/admin/db', function () {
    return view('admin-db');
});
Route::get('/user/dashboard', function () {
    return view('user-dashboard');
});

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/questionnaire', [QuestionnaireController::class, 'questionnaire'])->name('questionnaire');