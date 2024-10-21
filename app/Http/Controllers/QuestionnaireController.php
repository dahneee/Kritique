<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Teacher;
use App\Models\Subject; 
use App\Models\Questionnaire;
use App\Models\Answer; 
use Illuminate\Support\Facades\Auth;



class QuestionnaireController extends Controller
{
    public function create()
{
    // Check if the user is authenticated
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'You must be logged in to access this page.');
    }

    $userDepartment = Auth::user()->department; 

    $teachers = Teacher::where('department', $userDepartment)->get();
    $questions = Question::all();
    $subjects = Subject::all();

    return view('user-questionnaire', compact('teachers', 'questions', 'subjects'));
}

public function store(Request $request)
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'You must be logged in to submit the evaluation.');
    }
    
    $validatedData = $request->validate([
        'teacher_id' => 'required|exists:teachers,id',
        'subject_id' => 'required|exists:subjects,subject_id',
        'answers' => 'required|array',
        'answers.*' => 'required|integer|in:1,2,3,4,5',
    ]);
    
    // create questionnaire
    $questionnaire = Questionnaire::create([
        'student_id' => Auth::id(),
        'teacher_id' => $validatedData['teacher_id'],
        'subject_id' => $validatedData['subject_id'],
    ]);
    
    // store each answer in the answers table
    foreach ($validatedData['answers'] as $question_id => $answerText) {
        Answer::create([
            'questionnaire_id' => $questionnaire->id,
            'question_id' => $question_id,
            'answer' => $answerText,
            'subject_id' => $validatedData['subject_id'], // Include subject_id here
        ]);
    }
    
    return redirect()->route('questionnaires-create')->with('success', 'Evaluation submitted successfully.');
}
}
