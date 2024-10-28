<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Department;
use App\Models\Questionnaire;
use App\Models\User;
use App\Models\Block;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function index(Request $request)
    {
        $departmentId = $request->input('department');
        $evaluated = $request->input('evaluated');

        $teachers = Teacher::query();

        if ($departmentId) {
            $teachers->where('department', $departmentId);
        }

        if ($evaluated !== null) {
            if ($evaluated == '1') {
                $teachers->whereHas('questionnaires'); 
            } else {
                $teachers->whereDoesntHave('questionnaires'); 
            }
        }

        $departments = Department::all();
        $teachers = $teachers->get();

        return view('admin.teacher-list', compact('teachers', 'departments'));
    }


    public function showTeacherEvaluations(Request $request, $teacherId)
    {
        $selectedYear = $request->input('year');
        $selectedBlock = $request->input('block');

        $teacher = Teacher::with(['department', 'questionnaires.student' => function($query) use ($selectedYear, $selectedBlock) {
            if ($selectedYear) {
                $query->where('year', $selectedYear);
            }
            if ($selectedBlock) {
                $query->where('block', $selectedBlock);
            }
        }])->findOrFail($teacherId);

        $years = ['First', 'Second', 'Third', 'Fourth'];
        
        $blocks = Block::all();

        return view('admin.teacher-evaluations', compact('teacher', 'years', 'blocks', 'selectedYear', 'selectedBlock'));
    }


    public function showStudentAnswers($questionnaireId)
    {
        $questionnaire = Questionnaire::with(['student', 'answers.question'])->findOrFail($questionnaireId);
        
        return view('admin.student-answers', compact('questionnaire'));
    }
}