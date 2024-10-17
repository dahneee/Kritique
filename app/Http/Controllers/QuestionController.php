<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class QuestionController extends Controller
{
    public function index() {
        $questions = Question::all();
        return view('admin.questionnaire', compact('questions'));
    }

    public function store(Request $request) {

        $validated = $request->validate([
            'questions' => 'required|array|max:10',
            'questions.*' => 'required|string|max:200',
        ]);

        foreach ($validated['questions'] as $questionText) {
            Question::create(['text' => $questionText]);
        }

        return redirect()->back()->with('success', 'Questions saved successfully!');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'text' => 'required|string|max:200',
        ]);

        try {
            $question = Question::findOrFail($id);
            $question->text = $validated['text'];
            $question->save(); 

            return response()->json(['success' => true]); 
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to update the question.'], 500);  
        }
    }


    public function delete($id)
    {
        $question = Question::find($id);
        if ($question) {
            $question->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }

}
