<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Teacher;
use App\Models\Subject; 
use App\Models\Questionnaire;

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
        dd($request->all());
        // Validate the input
        $validatedData = $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'subject_id' => 'required|exists:subjects,subject_id',
            'answers' => 'required|array',
            'answers.*' => 'required|string|max:200',
        ]);

        $questionnaireData = [
            'student_id' => auth()->id(), 
            'teacher_id' => $validatedData['teacher_id'],
            'subject_id' => $validatedData['subject_id'],
            'answers' => json_encode($validatedData['answers']),
        ];

        $questionnaire = Questionnaire::create($questionnaireData);

        return redirect()->route('questionnaires-create')->with('success', 'Evaluation submitted successfully.');
    }



}
