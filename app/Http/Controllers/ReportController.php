<?php

namespace App\Http\Controllers;

use App\Models\Questionnaire;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $teachers = Teacher::all(); 
        return view('report', compact('teachers'));
    }

    public function showTeacherAnswers($id)
    {
        $answers = Questionnaire::where('teacher_id', $id)
            ->with(['student', 'answers.question'])
            ->get();

        return view('admin-teacher-answers', compact('answers'));
    }
}
