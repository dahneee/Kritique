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

    // Fetch questions assigned to a specific teacher and the number of respondents per question
    public function getQuestionsByTeacher($teacherId)
    {
        try {
            // Fetch questions linked to the teacher via questionnaires
            $questions = Question::whereHas('answers.questionnaire', function ($query) use ($teacherId) {
                $query->where('teacher_id', $teacherId);
            })->withCount(['answers' => function ($query) use ($teacherId) {
                $query->whereHas('questionnaire', function ($subQuery) use ($teacherId) {
                    $subQuery->where('teacher_id', $teacherId);
                });
            }])->get();

            $result = [];
            foreach ($questions as $question) {
                $result[] = [
                    'id' => $question->id,
                    'text' => $question->text,
                    'respondent_count' => $question->answers_count,
                ];
            }

            return response()->json(['questions' => $result]);
        } catch (\Exception $e) {
            Log::error('Error fetching questions: ' . $e->getMessage());
            return response()->json(['error' => 'Error fetching questions'], 500);
        }
    }

    // Fetch answers for a given question filtered by teacher
    public function getAnswersByQuestion($teacherId, $questionId)
    {
        try {
            Log::info('Fetching answers for question ID: ' . $questionId . ' and teacher ID: ' . $teacherId);

            // Fetch the question with its answers, filtered by the teacher
            $question = Question::with(['answers' => function ($query) use ($teacherId) {
                $query->whereHas('questionnaire', function ($subQuery) use ($teacherId) {
                    $subQuery->where('teacher_id', $teacherId);
                });
            }])->findOrFail($questionId);

            // Prepare the answers to return
            $answers = [];
            foreach ($question->answers as $answer) {
                $answers[] = [
                    'student_id' => optional($answer->student)->id, // Use optional() to avoid errors if student is null
                    'answer' => $answer->answer,
                ];
            }

            // Return question text and answers
            return response()->json(['question' => $question->text, 'answers' => $answers]);
        } catch (\Exception $e) {
            Log::error('Error fetching answers for question ID ' . $questionId . ': ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function getYearAndBlockCounts()
    {
        $totalStudents = \DB::table('users')->count();

        $yearCounts = Questionnaire::with('student')
            ->selectRaw('year, COUNT(*) as count')
            ->join('users', 'questionnaires.student_id', '=', 'users.id')
            ->groupBy('year')
            ->get();

        $blockCounts = Questionnaire::with('student')
            ->selectRaw('block, COUNT(*) as count')
            ->join('users', 'questionnaires.student_id', '=', 'users.id')
            ->groupBy('block')
            ->get();

        return response()->json(['yearCounts' => $yearCounts, 'blockCounts' => $blockCounts, 'totalStudents' => $totalStudents]);
    }

}
