<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/admin-dashboard.css">
    <link rel="stylesheet" href="/css/nav.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

@include('sidebar')

<div class="content-admin">
    <nav class="navbar-admin navbar-light">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center w-100">
                <h3 class="greet">Hello, <span class="name-greet">{{ Auth::user()->first_name }}</span>. <span class="space">How are you feeling today?</span></h3>

                <div class="dropdown">
                    <div class="circle-image" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="/src/default.png" alt="Profile Image">
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                {{ __('Profile') }}
                            </a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item" type="submit">
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>

<div class="container mt-4">
    <h1 class="text-center mb-4">Evaluation by {{ $questionnaire->student->first_name }} {{ $questionnaire->student->last_name }}</h1>
    <h2 class="text-center mb-4">Teacher: {{ $questionnaire->teacher->teacher_first_name }} {{ $questionnaire->teacher->teacher_last_name }}</h2>

    <!-- Display Student Details -->
    <div class="mb-4">
        <h5>Student Details:</h5>
        <ul class="list-group">
            <li class="list-group-item">Student ID: {{ $questionnaire->student->student_id }}</li>
            <li class="list-group-item">Full Name: {{ $questionnaire->student->first_name }} {{ $questionnaire->student->middle_name }} {{ $questionnaire->student->last_name }}</li>
            <li class="list-group-item">Block: {{ $questionnaire->student->block }}</li>
            <li class="list-group-item">Year: {{ $questionnaire->student->year }}</li>
            <li class="list-group-item">Department: {{ $questionnaire->student->department }}</li>
            <li class="list-group-item">Email: {{ $questionnaire->student->email }}</li>
        </ul>
    </div>

    <!-- Display Evaluation Answers -->
    <h5 class="mt-4">Evaluation Answers:</h5>
    <ul class="list-group mb-4">
        @foreach($questionnaire->answers as $answer)
            <li class="list-group-item text-success">
                <strong>{{ $answer->question->text }}</strong>: 
                @php
                    // Define the mapping of answer values to labels
                    $answerLabels = [
                        1 => 'Strongly Agree',
                        2 => 'Agree',
                        3 => 'Neutral',
                        4 => 'Disagree',
                        5 => 'Strongly Disagree',
                    ];
                @endphp
                {{ $answerLabels[$answer->answer] ?? 'No Answer' }} 
            </li>
        @endforeach
    </ul>

    <div class="text-center">
        <a href="{{ route('reports.showTeacherEvaluations', $questionnaire->teacher->id) }}" class="btn btn-primary" style="background-color: #a4d07b; border-color: #a4d07b;">
            Back to Students
        </a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
