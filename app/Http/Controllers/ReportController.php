<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Questionnaire;
use Illuminate\Http\Request;
use App\Models\Question;
use Illuminate\Support\Facades\Log;

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

    public function getQuestionsByTeacher($teacherId)
    {
        try {
            $questionnaires = Questionnaire::with(['answers.question', 'student'])
                ->where('teacher_id', $teacherId)
                ->get();
    
            // Get questions associated with those questionnaires
            $questions = Question::whereHas('answers.questionnaire', function ($query) use ($teacherId) {
                $query->where('teacher_id', $teacherId);
            })->get();
    
            return response()->json(['questions' => $questions, 'questionnaires' => $questionnaires]);
        } catch (\Exception $e) {
            Log::error('Error fetching questions: ' . $e->getMessage());
            return response()->json(['error' => 'Error fetching questions'], 500);
        }
    }
    
}
