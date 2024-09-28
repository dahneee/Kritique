<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Login')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .sidebar {
            min-width: 150px;
            background-color: #343a40;
            height: 100vh;
            padding: 20px;
        }

        .nav-link {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 15px;
            height: 100px;
            text-align: center;
            color: white;
            transition: background-color 0.3s ease;
        }

        .nav-link i {
            font-size: 1.5rem;
            margin-bottom: 5px;
        }

        .nav-link:hover {
            background-color: #495057;
            color: white;
        }

        .nav-link.active {
            background-color: #495057;
        }

        .logo {
            width: 100%;
            max-width: 120px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body style="background-color: beige;">
<nav class="navbar navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Kritique</a>
    </div>
</nav>

<div class="d-flex">
    <div class="bg-dark text-white sidebar">
        <img src="https://via.placeholder.com/120" alt="Logo" class="logo">
        
       
        <div class="offcanvas-body">
            <ul class="navbar-nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active text-center" aria-current="page" href="#">
                        <i class="fas fa-home"></i>
                        <span>Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-center" href="#">
                        <i class="fas fa-user"></i>
                        <span>Teachers</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-center" href="#">
                        <i class="fas fa-user"></i>
                        <span>Students</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-center" href="#">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="container mt-5 pt-5">
        <div class="card text-black bg-white mb-4">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h4 class="card-title text-start">Hi, Z.</h4>
                <p class="card-text text-start"></p>
                <button class="btn text-white bg-black">Create Questionnaire</button>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4 text-center">
                    <div class="card-body">
                        <i class="fas fa-chart-bar fa-2x mb-3"></i>
                        <h5 class="card-title">Statistics</h5>
                        <p class="card-text"></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 text-center">
                    <div class="card-body">
                        <i class="fas fa-chalkboard-teacher fa-2x mb-3"></i>
                        <h5 class="card-title">Teachers</h5>
                        <p class="card-text"></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 text-center">
                    <div class="card-body">
                        <i class="fas fa-user-graduate fa-2x mb-3"></i>
                        <h5 class="card-title">Students</h5>
                        <p class="card-text"></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <h3 class="text-center">Number of students who answered the survey</h3>
            <canvas id="myBarChart" style="background-color: white;" width="400" height="200"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    const ctx = document.getElementById('myBarChart').getContext('2d');
    const myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June'],
            datasets: [{
                label: 'Show',
                data: [12, 19, 3, 5, 2, 3], 
                backgroundColor: 'rgba(54, 162, 235, 0.6)', 
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#ccc' 
                    }
                },
                x: {
                    grid: {
                        color: '#ccc' 
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    enabled: true,
                }
            }
        }
    });
</script>
</body>
</html>
