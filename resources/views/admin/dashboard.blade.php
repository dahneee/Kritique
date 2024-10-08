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
                <h3 class="greet">Hello, <span class="name-greet">Zai</span>. <span class="space">How are you feeling today?</span></h3>
                <a href="{{ route('questionnaire') }}" class="create-btn">Questionnaire</a>

            </div>
        </div>
    </nav>
    </div>

<div class="content">
    <div class="container mt-4">
    <div class="row">
    <div class="col-md-3">
        <div class="metric-card">
            <div class="icon"><i class="fas fa-chalkboard-teacher"></i></div>
            <h4>Total Teachers</h4>
            <p>508</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="metric-card">
            <div class="icon"><i class="fas fa-user-graduate"></i></div>
            <h4>Total Students</h4>
            <p>387</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="metric-card">
            <div class="icon"><i class="fas fa-users"></i></div>
            <h4>Total Respondents</h4>
            <p>161</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="metric-card">
            <div class="icon"><i class="fas fa-question-circle"></i></div>
            <h4>Questionnaires Created</h4>
            <p>231</p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="chart-container">
            <h5>Total Users</h5>
            <canvas id="usersC" width="400" height="200"></canvas>
        </div>
    </div>

    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12 mt-4">
                <div class="metric-small">
                    <h5>Respondents</h5>
                    <p>
                        <span style="color: green;">Responded: 10%</span>  
                        <span style="color: orange;">&#9650; Pending 1%</span>
                    </p> 
                    <canvas id="projectsChart" width="200" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

    </div>
</div>

<script>
    
    const chartU = document.getElementById('usersC').getContext('2d');
    const usersC = new Chart(chartU, {
        type: 'line',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            datasets: [{
                label: 'Male',
                data: [200, 250, 300, 150, 350, 220],
                borderColor: 'rgba(255, 99, 132, 1)',
                fill: false
            }, {
                label: 'Female',
                data: [100, 150, 200, 100, 250, 150],
                borderColor: 'rgba(54, 162, 235, 1)',
                fill: false
            }, {
                label: 'Both',
                data: [100, 150, 200, 100, 250, 150],
                borderColor: 'rgba(0, 255, 0, 1)',
                fill: false
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const ctxProjects = document.getElementById('projectsChart').getContext('2d');
    const projectsChart = new Chart(ctxProjects, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Projects',
                data: [40, 42, 44, 46, 48, 50],
                borderColor: 'rgba(153, 102, 255, 1)',
                fill: false
            }]
        },
        options: {
            responsive: true,
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
