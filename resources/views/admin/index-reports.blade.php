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
    <link rel="stylesheet" href="/css/report.css">
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
                                Questions
                            </button>
                            <ul class="dropdown-menu" id="questionDropdown" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="#">Please select a teacher</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <canvas id="trafficChart" width="150" height="150"></canvas>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-group list-group-flush" id="responseList">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Strongly agree<span class="badge bg-primary rounded-pill">0%</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Agree <span class="badge bg-secondary rounded-pill">0%</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Neutral <span class="badge bg-warning rounded-pill">0%</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Disagree<span class="badge bg-danger rounded-pill">0%</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Strongly Disagree<span class="badge bg-danger rounded-pill">0%</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <p id="totalRespondents"><strong>Total Respondents: </strong> 0</p>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Initialize the chart
    const ctx = document.getElementById('trafficChart').getContext('2d');
    const trafficChart = new Chart(ctx, {
        type: 'doughnut', // Change to 'doughnut'
        data: {
            labels: ['Strongly Agree', 'Agree', 'Neutral', 'Disagree', 'Strongly Disagree'],
            datasets: [{
                label: 'Responses',
                data: [0, 0, 0, 0, 0], // Initial data
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            let label = tooltipItem.label || '';
                            if (tooltipItem.parsed > 0) {
                                label += ': ' + tooltipItem.parsed;
                            }
                            return label;
                        }
                    }
                }
            }
        }
    });

    // Fetch questions when a teacher is selected
    $('#teacherDropdown').change(function() {
        var teacherId = $(this).val(); // Get the selected teacher ID
        
        // Clear existing questions
        $('#questionDropdown').empty();
        $('#questionDropdown').append('<li><a class="dropdown-item" href="#">Please select a question</a></li>'); // Placeholder

        if (teacherId) {
            // Make an AJAX request to fetch questions for the selected teacher
            $.ajax({
                url: 'reports/get-questions/' + teacherId,
                type: 'GET',
                success: function(data) {
                    console.log(data); // Log the data to see its structure
                    if (data.questions && data.questions.length > 0) {
                        data.questions.forEach(function(question) {
                            $('#questionDropdown').append('<li><a class="dropdown-item" data-id="' + question.id + '" href="#">' + question.text + '</a></li>');
                        });
                    } else {
                        $('#questionDropdown').append('<li><a class="dropdown-item" href="#">No questions available.</a></li>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error loading questions:", error); // Log the error for easier debugging
                }
            });
        }
    });

    // Handle selection of questions
    $(document).on('click', '#questionDropdown .dropdown-item', function(event) {
        event.preventDefault(); // Prevent default anchor behavior
        var selectedQuestionId = $(this).data('id'); // Get the selected question ID

        // Ensure a valid question is selected
        if (!selectedQuestionId) {
            return;
        }

        // Clear existing data
        $('#responseList .list-group-item span').text('0%'); // Reset response percentages
        $('#totalRespondents').text('Total Respondents: 0'); // Reset total respondents

        // Make an AJAX request to fetch the answers for the selected question
        $.ajax({
            url: 'reports/get-answers/' + selectedQuestionId,
            type: 'GET',
            success: function(data) {
                console.log(data); // Log the data to see its structure
                let chartData = [0, 0, 0, 0, 0]; // Initialize chart data for responses
                let totalResponses = data.answers.length; // Total responses for this specific question

                // Count responses for the chart
                data.answers.forEach(answer => {
                    if (answer.answer >= 1 && answer.answer <= 5) {
                        chartData[answer.answer - 1]++; // Increment the respective answer count
                    }
                });

                // Update the chart with new data
                updateChart(chartData);
                $('#totalRespondents').text(`Total Respondents: ${totalResponses}`);

                // Update the response list
                $('#responseList .list-group-item').each(function(index) {
                    let percentage = totalResponses ? Math.round((chartData[index] / totalResponses) * 100) : 0; // Calculate percentage
                    $(this).find('span').text(percentage + '%'); // Update response percentage
                });
            },
            error: function(xhr, status, error) {
                $('#totalRespondents').text('Error loading answers.');
                console.error("Error loading answers:", error); // Log the error for easier debugging
            }
        });
    });

    // Function to update the chart
    function updateChart(data) {
        trafficChart.data.datasets[0].data = data; // Update dataset with new data
        trafficChart.update(); // Refresh the chart
    }
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
