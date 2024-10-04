<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestionnaireController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('user-dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/subjects', [SubjectController::class, 'index'])->name('admin.subjects');
    Route::get('/admin/questionnaire', [QuestionnaireController::class, 'questionnaire'])->name('questionnaire');
});


require __DIR__.'/auth.php';




// <?php

// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\AdminController;
// use App\Http\Controllers\QuestionnaireController;

// Route::get('/', function () {
//     return view('login');
// });

// Route::get('/admin/db', function () {
//     return view('admin-db');
// });
// Route::get('/user/dashboard', function () {
//     return view('user-dashboard');
// });

// Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
// Route::get('/questionnaire', [QuestionnaireController::class, 'questionnaire'])->name('questionnaire');