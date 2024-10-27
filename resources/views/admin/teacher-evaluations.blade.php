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
</head>
<body>

@include('sidebar')

<div class="content-admin">
    <nav class="navbar-admin navbar-light">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center w-100">
                <h3 class="greet">Hello, <span class="name-greet">{{ Auth::user()->first_name }}</span>. How are you feeling today?</h3>

                <div class="dropdown">
                    <div class="circle-image" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="/src/default.png" alt="Profile Image">
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item" type="submit">{{ __('Log Out') }}</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>

<div class="container mt-4">
    <h1 class="text-center mb-4">Evaluations for {{ $teacher->teacher_first_name }} {{ $teacher->teacher_last_name }}</h1>
    <h5 class="text-center mb-4">Department: {{ $teacher->department }}</h5>
    <form method="GET" action="{{ route('answers.showTeacherEvaluations', $teacher->id) }}" class="mb-4">
        <div class="row">
            <div class="col">
            <select name="year" class="form-select">
                <option value="">Select Year</option>
                @foreach ($years ?? [] as $year)  {{-- Using null coalescing operator to prevent errors --}}
                    <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>{{ $year }}</option>
                @endforeach
            </select>

            </div>
            <div class="col">
                <select name="block" class="form-select">
                    <option value="">Select Block</option>
                    @foreach ($blocks ?? [] as $block)
                        <option value="{{ $block->block_id }}" {{ $selectedBlock == $block->block_id ? 'selected' : '' }}>
                            {{ $block->block_id }} 
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary" style="background-color: #a4d07b; border-color: #a4d07b;">Filter</button>
            </div>
        </div>
    </form>

    <ul class="list-group mb-4">
        @forelse($teacher->questionnaires as $questionnaire)
            @if ($questionnaire->student)
                <li class="list-group-item">
                    <a href="{{ route('answers.showStudentAnswers', $questionnaire->id) }}" class="text-success text-decoration-none">
                        {{ $questionnaire->student->first_name }} {{ $questionnaire->student->last_name }}
                    </a>
                </li>
            @endif
        @empty
            <li class="list-group-item text-center">NO EVALUATIONS</li>
        @endforelse
    </ul>

    <div class="text-center">
        <a href="{{ route('answers.index') }}" class="btn btn-primary" style="background-color: #a4d07b; border-color: #a4d07b;">
            Back to Teachers
        </a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
