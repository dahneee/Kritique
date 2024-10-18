<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Teacher;
use App\Models\Subject; 
use App\Models\Questionnaire;
use App\Models\Answer; // Import the Answer model

class QuestionnaireController extends Controller
{
    public function create()
    {
        $teachers = Teacher::all();
        $questions = Question::all();
        $subjects = Subject::all(); 

        return view('user-questionnaire', compact('teachers', 'questions', 'subjects')); 
    }

    public function store(Request $request)
    {
        // Validate the input
        $validatedData = $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'subject_id' => 'required|exists:subjects,subject_id',
            'answers' => 'required|array',
            'answers.*' => 'required|string|max:200',
        ]);

        // Create the questionnaire entry
        $questionnaire = Questionnaire::create([
            'student_id' => auth()->id(),
            'teacher_id' => $validatedData['teacher_id'],
            'subject_id' => $validatedData['subject_id'],
        ]);

        // Store each answer in the answers table
        foreach ($validatedData['answers'] as $question_id => $answerText) {
            Answer::create([
                'questionnaire_id' => $questionnaire->id,
                'question_id' => $question_id,
                'answer' => $answerText,
            ]);
        }

        return redirect()->route('questionnaires-create')->with('success', 'Evaluation submitted successfully.');
    }
}
