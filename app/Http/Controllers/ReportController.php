<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Questionnaire;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $teachers = Teacher::all();

        return view('admin.index-reports', compact('teachers'));
    }

    public function showTeacherEvaluations($teacherId)
    {
        $teacher = Teacher::with('questionnaires.student')->findOrFail($teacherId);

        return view('admin.teacher-evaluations', compact('teacher'));
    }

    public function showStudentAnswers($questionnaireId)
    {
        $questionnaire = Questionnaire::with(['answers.question', 'student'])->findOrFail($questionnaireId);

        return view('admin.student-answers', compact('questionnaire'));
    }
}
