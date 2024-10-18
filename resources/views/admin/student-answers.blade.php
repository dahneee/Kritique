<h1>Evaluation by {{ $questionnaire->student->first_name }} {{ $questionnaire->student->last_name }}</h1>

    <h2>Teacher: {{ $questionnaire->teacher->teacher_first_name }} {{ $questionnaire->teacher->teacher_last_name }}</h2>

    <ul>
        @foreach($questionnaire->answers as $answer)
            <li>
                <strong>{{ $answer->question->text }}</strong>: {{ $answer->answer }}
            </li>
        @endforeach
    </ul>

    <a href="{{ route('reports.showTeacherEvaluations', $questionnaire->teacher->id) }}">Back to Students</a>