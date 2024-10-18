<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Report</title>

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

                <div class="mb-3">
                    <select class="form-select" aria-label="Select Teacher" id="teacherDropdown">
                        <option selected disabled>Select a teacher</option>
                        @if($teachers->isEmpty())
                            <option>No teachers available for evaluation.</option>
                        @else
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->teacher_first_name }} {{ $teacher->teacher_last_name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
        </div>
    </nav>
</div>
<div class="content container">
    <div class="row mb-4">
        <div class="col-lg-12 col-md-12">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title">Results Overview</h5>
                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                Department
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="#">CITE</a></li>
                                <li><a class="dropdown-item" href="#">CEA</a></li>
                                <li><a class="dropdown-item" href="#">CMA</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <canvas id="trafficChart" width="150" height="150"></canvas>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Q1 <span class="badge bg-primary rounded-pill">45%</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Q2 <span class="badge bg-secondary rounded-pill">25%</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Q3 <span class="badge bg-warning rounded-pill">15%</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Q4 <span class="badge bg-danger rounded-pill">10%</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Other <span class="badge bg-info rounded-pill">5%</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <p><strong>Total Respondents: </strong> 50</p>
                    </div>

                   
                    <div class="row mt-4">
                        <div class="d-flex justify-content-around flex-wrap">
                            <div class="col-md-2 col-6 mb-3 ">
                                <div class="card shadow-sm p-3">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h6 class="card-title">CAS</h6>
                                        </div>
                                        <span class="badge bg-warning text-white fs-5">4</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-6 mb-3">
                                <div class="card shadow-sm p-3">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h6 class="card-title">CITE</h6>
                                        </div>
                                        <span class="badge bg-danger text-white fs-5">65</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-6 mb-3">
                                <div class="card shadow-sm p-3">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h6 class="card-title">CAHS</h6>
                                        </div>
                                        <span class="badge bg-danger text-white fs-5">65</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-6 mb-3">
                                <div class="card shadow-sm p-3">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h6 class="card-title">CMA</h6>
                                        </div>
                                        <span class="badge bg-primary text-white fs-5">5</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-6 mb-3">
                                <div class="card shadow-sm p-3">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h6 class="card-title">CEA</h6>
                                        </div>
                                        <span class="badge bg-success text-white fs-5">5</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-6 mb-3">
                                <div class="card shadow-sm p-3">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h6 class="card-title">CELA</h6>
                                        </div>
                                        <span class="badge bg-danger text-white fs-5">65</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title">Block</h5>
                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                Course
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="#">CITE</a></li>
                                <li><a class="dropdown-item" href="#">CEA</a></li>
                                <li><a class="dropdown-item" href="#">CMA</a></li>
                            </ul>
                        </div>
                    </div>
                  
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="d-flex justify-content-between">
                                <span>Block 1</span>
                                <span>195</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 40%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        
                        <div class="col-12 mb-3">
                            <div class="d-flex justify-content-between">
                                <span>Block 2</span>
                                <span>355</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 70%;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <div class="d-flex justify-content-between">
                                <span>Block 3</span>
                                <span>105</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    </div>

 
  

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Initialize Chart.js for the traffic overview pie chart
    var ctx = document.getElementById('trafficChart').getContext('2d');
    var trafficChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Q1', 'Q2', 'Q3', 'Q4', 'Other'],
            datasets: [{
                label: 'Traffic',
                data: [45, 25, 15, 10, 5],
                backgroundColor: ['#007bff', '#6c757d', '#ffc107', '#dc3545', '#17a2b8'],
                borderColor: ['#ffffff'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>
</body>
</html>
