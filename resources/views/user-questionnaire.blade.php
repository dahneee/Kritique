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

    <form action="{{ route('questionnaires-store') }}" method="POST">
    @csrf
    <div>
        <label for="teacher_id">Select Teacher to Evaluate:</label>
        <select id="teacher_id" name="teacher_id" required>
            @foreach($teachers as $teacher)
                <option value="{{ $teacher->id }}">{{ $teacher->teacher_first_name }} {{ $teacher->teacher_last_name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="subject_id">Select Subject:</label>
        <select id="subject_id" name="subject_id" required>
            @foreach($subjects as $subject)
                <option value="{{ $subject->subject_id }}">{{ $subject->subject_name }}</option>
            @endforeach
        </select>
    </div>

    @foreach($questions as $question)
        <div>
            <label for="question_{{ $question->id }}">{{ $question->text }}</label>
            <input type="text" id="question_{{ $question->id }}" name="answers[{{ $question->id }}]" required>
        </div>
    @endforeach
    
    <button type="submit">Submit</button>
</form>


</x-app-layout>