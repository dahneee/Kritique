<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class QuestionnaireController extends Controller
{
    public function questionnaire()
    {
        $questions = Question::all();

        return view('questionnaire', compact('questions'));
    }
    public function saveQuestions(Request $request)
    {
        $validated = $request->validate([
            'questions' => 'required|array|max:10',
            'questions.*' => 'required|string|max:200',
        ]);

        foreach ($validated['questions'] as $questionText) {
            Question::create(['text' => $questionText]);
        }

        return redirect()->back()->with('success', 'Questions saved successfully!');
    }

    public function deleteQuestion($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();

        return response()->json(['success' => 'Question deleted successfully.']);
    }
}
