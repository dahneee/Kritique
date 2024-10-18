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

<div class="content">
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-3">
                <div class="metric-card">
                    <button type="button" class="btn-icon" onclick="window.location='{{ route('view-teachers') }}'">
                        <div class="icon"><i class="fas fa-chalkboard-teacher"></i></div>
                    </button>
                    <h4>Total Teachers</h4>
                    <p>{{ $totalTeachers }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="metric-card">
                    <button type="button" class="btn-icon" onclick="window.location='{{ route('view-student') }}'">
                        <div class="icon"><i class="fas fa-user-graduate"></i></div>
                    </button>
                    <h4>Total Students</h4>
                    <p>{{ $totalStudents }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="metric-card">
                    <div class="icon"><i class="fas fa-users"></i></div>
                    <h4>Total Submissions</h4>
                    <p>{{ $totalSubmissions }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="metric-card">
                    <div class="icon"><i class="fas fa-question-circle"></i></div>
                    <h4>Questions Created</h4>
                    <p>{{ $totalQuestions }}</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="chart-container">
                    <h5>Population</h5>
                    <canvas id="usersC" width="400" height="200"></canvas>
                </div>
            </div>

            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-12 mt-4">
                        <div class="metric-small">
                            <h5>Respondents</h5>
                            <canvas id="projectsChart" width="200" height="100"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const departments = @json($departments);
    const studentCounts = @json($studentCounts);
    const teacherCounts = @json($teacherCounts);
    const studentsPerDepartment = @json($studentsPerDepartment);

    const chartP = document.getElementById('projectsChart').getContext('2d');
    const projectsChart = new Chart(chartP, {
        type: 'doughnut',
        data: {
            labels: departments,
            datasets: [{
                label: 'Number of Students Who Answered',
                data: studentCounts,
                backgroundColor: [
                    'rgba(123, 199, 148, 1)', 
                    'rgba(255, 192, 203, 1)', 
                    'rgba(173, 216, 230, 1)', 
                    'rgba(255, 239, 150, 1)', 
                    'rgba(155, 233, 239, 1)', 
                    'rgba(195, 160, 240, 1)',
                    'rgba(255, 210, 128, 1)', 
                ]


            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                }
            }
        }
    });

    const ctx = document.getElementById('usersC').getContext('2d');
    const combinedChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: departments,
            datasets: [
                {
                    label: 'Students',
                    data: studentsPerDepartment,
                    backgroundColor: 'rgba(109, 207, 152, 0.7)', 
                    borderColor: 'rgba(109, 207, 152, 1)', 
                    borderWidth: 1
                },
                {
                    label: 'Teachers',
                    data: teacherCounts,
                    backgroundColor: 'rgba(255, 182, 193, 0.7)', 
                    borderColor: 'rgba(255, 182, 193, 1)', 
                    borderWidth: 1
                },
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
</body>
</html>
