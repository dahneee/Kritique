<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('questionnaires-store') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label for="teacher_id" class="block mb-2 text-sm font-medium text-gray-900">Select Teacher to Evaluate:</label>
                <select id="teacher_id" name="teacher_id" class="w-full p-2 border border-gray-300 rounded-lg" required>
                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}">{{ $teacher->teacher_first_name }} {{ $teacher->teacher_last_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-6">
                <label for="subject_id" class="block mb-2 text-sm font-medium text-gray-900">Select Subject:</label>
                <select id="subject_id" name="subject_id" class="w-full p-2 border border-gray-300 rounded-lg" required>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->subject_id }}">{{ $subject->subject_name }}</option>
                    @endforeach
                </select>
            </div>

            @foreach($questions as $question)
    <div class="mb-6 bg-purple-100 p-4 rounded-lg shadow-sm">
        <label for="question_{{ $question->id }}" class="block mb-2 text-lg font-medium text-gray-800">{{ $question->text }}</label>

        <div class="flex items-center space-x-4">
            <div>
                <input type="radio" id="answer_1_{{ $question->id }}" name="answers[{{ $question->id }}]" value="1" class="mr-2" required>
                <label for="answer_1_{{ $question->id }}">Strongly Agree</label>
            </div>

            <div>
                <input type="radio" id="answer_2_{{ $question->id }}" name="answers[{{ $question->id }}]" value="2" class="mr-2" required>
                <label for="answer_2_{{ $question->id }}">Agree</label>
            </div>

            <div>
                <input type="radio" id="answer_3_{{ $question->id }}" name="answers[{{ $question->id }}]" value="3" class="mr-2" required>
                <label for="answer_3_{{ $question->id }}">Neutral</label>
            </div>

            <div>
                <input type="radio" id="answer_4_{{ $question->id }}" name="answers[{{ $question->id }}]" value="4" class="mr-2" required>
                <label for="answer_4_{{ $question->id }}">Disagree</label>
            </div>

            <div>
                <input type="radio" id="answer_5_{{ $question->id }}" name="answers[{{ $question->id }}]" value="5" class="mr-2" required>
                <label for="answer_5_{{ $question->id }}">Strongly Disagree</label>
            </div>
        </div>
    </div>
@endforeach


            <div class="text-right">
                <button type="submit" class="px-6 py-2 text-white bg-purple-600 rounded-lg shadow-md hover:bg-purple-700">
                    Submit
                </button>
            </div>
        </form>
    </div>

</x-app-layout>
