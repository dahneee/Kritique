<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Questionnaire;
use Illuminate\Http\Request;
use App\Models\Question;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

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

    public function getAnswersByQuestion($teacherId, $questionId)
    {
        try {
            Log::info('Fetching answers for question ID: ' . $questionId . ' and teacher ID: ' . $teacherId);
    
            // Eager load student with their block and answers
            $questionnaires = Questionnaire::with(['student.block', 'answers' => function ($query) use ($questionId) {
                $query->where('question_id', $questionId);
            }])->where('teacher_id', $teacherId)->get();
    
            $answers = [];
            $departments = [];
            $yearCounts = []; // Array to hold counts by year
            $blockCounts = array_fill(1, 10, 0); // Initialize counts for Block 1 to Block 10
    
            foreach ($questionnaires as $questionnaire) {
                foreach ($questionnaire->answers as $answer) {
                    $student = $questionnaire->student;
                    $year = $student->year; // Assuming year is a property of student
                    $block = $student->block; // Get block ID from the block relationship
                    $department = $student->department;
    
                    // Populate answers array
                    $answers[] = [
                        'student_id' => $student->id,
                        'first_name' => $student->first_name,
                        'last_name' => $student->last_name,
                        'year' => $year,
                        'block' => $block,
                        'department' => $department,
                        'answer' => $answer->answer,
                    ];
                    $departments[$department] = true;
    
                    // Count year occurrences for the selected department
                    if (!isset($yearCounts[$year])) {
                        $yearCounts[$year] = 0;
                    }
                    $yearCounts[$year]++;
                    
                    // Count block occurrences using string as key
                if (!isset($blockCounts[$block])) {
                    $blockCounts[$block] = 0;
                }
                $blockCounts[$block]++;
            }
        }
    
            // Log the student details fetched
            Log::info('Fetched student answers:', ['answers' => $answers]);
    
            // Return the data including year and block counts
            return response()->json([
                'question' => $questionId,
                'answers' => $answers,
                'departments' => array_keys($departments),
                'yearCounts' => $yearCounts, // Send year counts
                'blockCounts' => $blockCounts, // Send block counts
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching answers for question ID ' . $questionId . ': ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    public function getYearStatistics(Request $request, $department)
{
    $teacherId = $request->input('teacher_id'); 
    $questionId = $request->input('question_id'); 

    try {
        // Fetch questionnaires filtered by teacher and department string
        $questionnaires = Questionnaire::with(['student'])
            ->where('teacher_id', $teacherId)
            ->whereHas('student', function ($query) use ($department) {
                $query->where('department', $department); // Filter by department string
            })
            ->get();

        // Initialize an array to hold counts per year
        $yearStatistics = [];

        // Loop through each questionnaire to count responses by year
        foreach ($questionnaires as $questionnaire) {
            $student = $questionnaire->student; // Get the student related to the questionnaire
            if ($student) {
                $year = $student->year; // Get the year of the student

                // Initialize the year count if it doesn't exist
                if (!isset($yearStatistics[$year])) {
                    $yearStatistics[$year] = 0;
                }

                // Count responses based on the selected question
                if ($questionnaire->answers()->where('question_id', $questionId)->exists()) {
                    $yearStatistics[$year]++;
                }
            }
        }

        // Prepare the response with statistics
        return response()->json(['years' => $yearStatistics]);
    } catch (\Exception $e) {
        Log::error('Error fetching year statistics: ' . $e->getMessage());
        return response()->json(['error' => 'Error fetching year statistics'], 500);
    }
}

}
