<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\QuestionnaireController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('user-intro');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/subjects', [SubjectController::class, 'index'])->name('admin.subjects');

    Route::get('/admin/questionnaire', [QuestionController::class, 'index'])->name('show-questions');
    Route::post('/admin/questionnaire/store', [QuestionController::class, 'store'])->name('save-questions');
    Route::delete('/admin/questionnaire/{id}/delete', [QuestionController::class, 'delete'])->name('delete-question');
    Route::put('/admin/questionnaire/{id}/update', [QuestionController::class, 'update'])->name('update-question');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('reports/get-questions/{teacherId}', [ReportController::class, 'getQuestionsByTeacher'])->name('reports.getQuestions');
    Route::get('reports/get-answers/{teacherId}/{questionId}', [ReportController::class, 'getAnswersByQuestion'])->name('reports.getAnswers');
    Route::get('/reports/teacher/{teacherId}', [ReportController::class, 'showTeacherEvaluations'])->name('reports.showTeacherEvaluations');
    Route::get('/reports/student/{questionnaireId}', [ReportController::class, 'showStudentAnswers'])->name('reports.showStudentAnswers');
    Route::get('/reports/year-block', [ReportController::class, 'getYearAndBlockCounts']);



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
    Route::put('/admin/teachers/update/{id}', [TeacherController::class, 'update'])->name('update-teacher');
    Route::get('/admin/teachers/delete/{id}', [TeacherController::class, 'delete'])->name('delete-teacher');

    Route::get('/export-users', [StudentController::class, 'exportToExcel'])->name('export-users');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/questionnaires/create', [QuestionnaireController::class, 'create'])->name('questionnaires-create');
    Route::get('/student/intro', [HomeController::class, 'index'])->name('student-intro');
    Route::post('/questionnaires/store', [QuestionnaireController::class, 'store'])->name('questionnaires-store');
});


require __DIR__.'/auth.php';


