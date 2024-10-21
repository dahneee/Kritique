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

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
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
                        @foreach(['Strongly Agree' => 1, 'Agree' => 2, 'Neutral' => 3, 'Disagree' => 4, 'Strongly Disagree' => 5] as $label => $value)
                            <div>
                                <input type="radio" id="answer_{{ $value }}_{{ $question->id }}" name="answers[{{ $question->id }}]" value="{{ $value }}" class="mr-2" required>
                                <label for="answer_{{ $value }}_{{ $question->id }}">{{ $label }}</label>
                            </div>
                        @endforeach
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
