<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestionnaireController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ReportController;
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

    Route::get('/admin/questionnaire', [QuestionController::class, 'index'])->name('show-questions');
    Route::post('/admin/questionnaire/store', [QuestionController::class, 'store'])->name('save-questions');
    Route::delete('/admin/questionnaire/{id}/delete', [QuestionController::class, 'delete'])->name('delete-question');
    Route::put('/admin/questionnaire/{id}/update', [QuestionController::class, 'update'])->name('update-question');

    Route::get('/admin/reports', [ReportController::class, 'index'])->name('admin-reports');
    Route::get('/admin/teacher/{id}/answers', [ReportController::class, 'showTeacherAnswers'])->name('admin-teacher-answers');

    Route::get('/admin/students', [StudentController::class, 'index'])->name('view-student');
    Route::get('/admin/students/create', [StudentController::class, 'create'])->name('create-student');
    Route::post('/admin/students/save', [StudentController::class, 'save'])->name('save-student');
    Route::get('/admin/students/edit/{id}', [StudentController::class, 'edit'])->name('edit-student');
    Route::put('/admin/students/update/{id}', [StudentController::class, 'update'])->name('update-student');
    Route::get('/admin/students/delete/{id}', [StudentController::class, 'delete'])->name('delete-student');

    Route::get('/admin/teachers', [TeacherController::class, 'index'])->name('view-teachers');
    Route::get('/admin/teachers/create', [TeacherController::class, 'create'])->name('create-teacher');
    Route::post('/admin/teachers/save', [TeacherController::class, 'save'])->name('save-teacher');
    Route::get('/admin/teachers/edit/{id}', [TeacherController::class, 'edit'])->name('edit-teacher');
    Route::put('/admin/teachers/edit/{id}', [TeacherController::class, 'update'])->name('update-teacher');
    Route::get('/admin/teachers/delete/{id}', [TeacherController::class, 'delete'])->name('delete-teacher');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/questionnaires/create', [QuestionnaireController::class, 'create'])->name('questionnaires-create');
    Route::post('/questionnaires/store', [QuestionnaireController::class, 'store'])->name('questionnaires-store');
});


require __DIR__.'/auth.php';


