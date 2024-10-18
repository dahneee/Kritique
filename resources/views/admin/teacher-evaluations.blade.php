<h1>Evaluations for {{ $teacher->teacher_first_name }} {{ $teacher->teacher_last_name }}</h1>

    <ul>
        @foreach($teacher->questionnaires as $questionnaire)
            <li>
                <a href="{{ route('reports.showStudentAnswers', $questionnaire->id) }}">
                    {{ $questionnaire->student->first_name }} {{ $questionnaire->student->last_name }}
                </a>
            </li>
        @endforeach
    </ul>

    <a href="{{ route('reports.index') }}">Back to Teachers</a>