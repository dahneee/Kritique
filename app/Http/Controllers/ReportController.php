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
        // Fetch questions for the teacher
        $questions = Question::with('answers')
            ->whereHas('answers.questionnaire', function ($query) use ($teacherId) {
                $query->where('teacher_id', $teacherId);
            })->get();

        $result = [];
        foreach ($questions as $question) {
            $respondentCount = $question->answers->count(); // Get the count of answers
            $result[] = [
                'id' => $question->id,
                'text' => $question->text,
                'respondent_count' => $respondentCount,
            ];
        }

        return response()->json(['questions' => $result]);
    } catch (\Exception $e) {
        Log::error('Error fetching questions: ' . $e->getMessage());
        return response()->json(['error' => 'Error fetching questions'], 500);
    }
}


public function getAnswersByQuestion($questionId)
{
    try {
        Log::info('Fetching answers for question ID: ' . $questionId);
        
        // Fetch the question with its answers
        $question = Question::with('answers.student')->findOrFail($questionId);

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




}
