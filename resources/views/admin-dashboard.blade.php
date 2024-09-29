<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
       
        body {
            background-color: white;
            font-family: 'Poppins', sans-serif; 
        }

        .sidebar {
            width: 80px;
            height: 100vh;
            background-color: #8FBF66;
            padding-top: 10px;
            position: fixed;
            transition: width 0.3s;
        }

        .sidebar:hover {
            width: 220px;
        }

        .sidebar a {
            padding: 10px;
            text-decoration: none;
            font-size: 16px;
            color: black;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: background-color 0.2s;
        }

        .sidebar a:hover {
            background-color: #A8D7B7;
        }

        .sidebar a span {
            opacity: 0;
            transition: opacity 0.3s;
        }

        .sidebar:hover a span {
            opacity: 1;
        }

        .sidebar img {
            transition: width 0.3s;
            width: 50px; 
        }

        .sidebar:hover img {
            width: 100px;
        }

        .sidebar h3 {
            opacity: 0;
            font-style:Poppins;
            font-weight:bold;
            transition: opacity 0.3s;
            color: white !important;
            padding:20px;
        }

        .sidebar:hover h3 {
            opacity: 1;
        }

        .content {
            margin-left: 80px;
            padding: 20px;
            transition: margin-left 0.3s;
        }

        .sidebar:hover ~ .content {
            margin-left: 250px;
        }

        .navbar {
            background-color: ;
            color:#A4D07B;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .navbar  h3{
            color:#A4D07B;
            font-weight:bold;
        }

        .metric-card {
            padding: 20px;
            border-radius: 10px;
            color: white;
            margin-bottom: 20px;
            text-align: center;
        }

        .metric-card h4 {
            margin-bottom: 10px;
            font-size:15px;
        }

        .metric-card .icon {
            font-size: 2.5rem;
            margin-bottom: 10px;
            
        }

        .metric-small {
    border-radius: 10px;
    padding: 20px;
    text-align: center;
    background-color: white;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); 
}


        .chart-container {
    background-color: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1); 
}



    </style>
</head>
<body>

<div class="sidebar d-flex flex-column align-items-center">
    <div class="text-center mb-3">
        <h3 class="mt-2">Kritique</h3> 
    </div>
    <div class="text-center mb-3">
        <h5 class="mt-1" style="color: black !important; opacity: 0;">Zaisuki</h5>
    </div>
    <a href="#" class="sidebar-link text-center d-flex flex-column align-items-center" style="color: white !important;">
        <i class="fas fa-home fa-2x"></i>
        <span>Dashboard</span>
    </a>
    <a href="#" class="sidebar-link text-center d-flex flex-column align-items-center" style="color: white !important;">
        <i class="fas fa-chart-pie fa-2x"></i>
        <span>Analytics</span>
    </a>
    <a href="#" class="sidebar-link text-center d-flex flex-column align-items-center" style="color:white !important;">
        <i class="fas fa-question-circle fa-2x"></i> 
        <span>Questionnaire</span>
    </a>
    <a href="#" class="sidebar-link text-center d-flex flex-column align-items-center" style="color: white !important;">
    <i class="fas fa-sign-out-alt fa-2x"></i> 
    <span>Logout</span>
</a>

</div>


<div class="content">
    <!-- Navbar -->
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center w-100">
                <h3 class="fs-5 mb-0">Hi, Z. Welcome back</h3>
                <button class="btn btn-primary" style="background-color: white; border-color: transparent; color: #A4D07B; font-weight:bold; ">Create Questionnaire</button>
            </div>
        </div>
    </nav>


    <div class="container mt-4">
    <div class="row">
    <div class="col-md-3">
        <div class="metric-card" style="background-color: white; color: #333; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <div class="icon" style="color: #A4D07B;"><i class="fas fa-chalkboard-teacher"></i></div>
            <h4>Total Teachers</h4>
            <p>508</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="metric-card" style="background-color: white; color: #333; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <div class="icon" style="color: #A4D07B;"><i class="fas fa-user-graduate"></i></div>
            <h4>Total Students</h4>
            <p>387</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="metric-card" style="background-color: white; color: #333; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <div class="icon" style="color: #A4D07B;"><i class="fas fa-users"></i></div>
            <h4>Total Respondents</h4>
            <p>161</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="metric-card" style="background-color: white; color: #333; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <div class="icon" style="color: #A4D07B;"><i class="fas fa-question-circle"></i></div>
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
