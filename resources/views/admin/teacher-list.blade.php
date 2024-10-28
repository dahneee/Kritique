<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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

<div class="content container mt-4">
    <h1 class="text-center mb-4">Summary of Answers</h1>
    
    <!-- Filter Form -->
    <form method="GET" action="{{ route('answers.index') }}" class="mb-4">
        <div class="mb-3">
            <label for="department" class="form-label">Filter Teachers by Department</label>
            <select id="department" name="department" class="form-select" onchange="this.form.submit()">
                <option value="">All Departments</option>
                @foreach($departments as $department)
                    <option value="{{ $department->department_id }}" {{ request('department') == $department->department_id ? 'selected' : '' }}>
                        {{ $department->department_id }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Filter Teachers by Evaluation Status</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="evaluated" id="evaluatedAll" value="" {{ request('evaluated') === null ? 'checked' : '' }} onchange="this.form.submit()">
                <label class="form-check-label" for="evaluatedAll">
                    All Teachers
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="evaluated" id="evaluated1" value="1" {{ request('evaluated') == '1' ? 'checked' : '' }} onchange="this.form.submit()">
                <label class="form-check-label" for="evaluated1">
                    Evaluated
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="evaluated" id="evaluated0" value="0" {{ request('evaluated') == '0' ? 'checked' : '' }} onchange="this.form.submit()">
                <label class="form-check-label" for="evaluated0">
                    Not Evaluated
                </label>
            </div>
        </div>
    </form>
    
    <ul class="list-group">
        @foreach($teachers as $teacher)
            <li class="list-group-item">
                <a href="{{ route('answers.showTeacherEvaluations', $teacher->id) }}" class="text-success text-decoration-none">
                    {{ $teacher->teacher_first_name }} {{ $teacher->teacher_last_name }}
                </a>
            </li>
        @endforeach
    </ul>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
