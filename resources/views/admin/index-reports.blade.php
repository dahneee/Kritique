<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Report</title>

    <!-- Fonts & Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

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
        <nav class="navbar-admin navbar-light mb-4">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <h3 class="greet">Hello, <span class="name-greet" style='color:green;'>{{ Auth::user()->first_name }}</span>. <span class="space">How are you feeling today?</span></h3>
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

       


        <div class="content container">
            <div class="row mb-4">
                <div class="col-lg-6">
                    <div class="card shadow-sm mb-4 chart-container">
                        <div class="card-body">
                            <canvas id="trafficChart" width="100%" height="100%"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Response Distribution</h5>
                            <div class="container question-dropdown">
            <div class="dropdown secret-dropdown">
                <button class="btn-select-q btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    Select Question
                </button>
                <ul class="dropdown-menu" id="questionDropdown" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="#">Please select a teacher first</a></li>
                </ul>
            </div>
        </div>
                            <ul class="list-group list-group-flush" id="responseList">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Strongly Agree 
                                            <span class="badge" style="background-color: #A4D07B; border: 1px solid #B1D490;">0%</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Agree 
                                            <span class="badge" style="background-color: #A4D07B; border: 1px solid #B1D490;">0%</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Neutral 
                                            <span class="badge" style="background-color: #A4D07B; border: 1px solid #B1D490;">0%</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Disagree 
                                            <span class="badge" style="background-color: #A4D07B; border: 1px solid #B1D490;">0%</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Strongly Disagree 
                                            <span class="badge" style="background-color: #A4D07B; border: 1px solid #B1D490;">0%</span>
                                        </li>

                            </ul>
                            <p id="totalRespondents" class="mt-3"><strong>Total Respondents: </strong> 0</p>
                        </div>
                    </div>
                </div>
            </div>

       
            <div class="row">
    <div class="col-lg-12">
        <div class="card shadow-sm mb-4 chart-container">
            <div class="card-body">
                <h5 class="card-title">Year Statistics</h5>
                <div class="dropdown mb-3">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="departmentDropdownButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Select Department
                    </button>
                    <ul class="dropdown-menu" id="departmentDropdownMenu" aria-labelledby="departmentDropdownButton"></ul>
                </div>
                <div id="yearProgressBars" class="row"></div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow-sm mb-4 chart-container">
            <div class="card-body">
                <h5 class="card-title">Block Statistics</h5>
                <div id="blockProgressBars" class="row"></div>
            </div>
        </div>
    </div>
</div>


 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


    <script>
        let fetchedData = null;
$(document).ready(function () {
    const ctx = document.getElementById('trafficChart').getContext('2d');
    const trafficChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Strongly Agree', 'Agree', 'Neutral', 'Disagree', 'Strongly Disagree'],
            datasets: [{
                label: 'Responses',
                data: [0, 0, 0, 0, 0],
                backgroundColor: [
                    '#A4D07B', 
                    '#B1D490', 
                    '#BED8A5', 
                    '#CBECC0',
                    '#ffff',
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            animation: {
                duration: 2000, 
                easing: 'easeInOutBounce'
            },
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function (tooltipItem) {
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

    // Teacher dropdown change event
    $('#teacherDropdown').change(function () {
        var teacherId = $(this).val(); 
        $('#questionDropdown').empty();
        $('#questionDropdown').append('<li><a class="dropdown-item" href="#">Please select a question</a></li>'); 

        if (teacherId) {
            $.ajax({
                url: 'reports/get-questions/' + teacherId,
                type: 'GET',
                success: function (data) {
                    console.log(data); 
                    if (data.questions && data.questions.length > 0) {
                        data.questions.forEach(function (question) {
                            $('#questionDropdown').append('<li><a class="dropdown-item" data-id="' + question.id + '" href="#">' + question.text + '</a></li>');
                        });
                    } else {
                        $('#questionDropdown').append('<li><a class="dropdown-item" href="#">No questions available.</a></li>');
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error loading questions:", error);
                }
            });
        }
    });

    // Question dropdown item click event
    $(document).on('click', '#questionDropdown .dropdown-item', function (event) {
        event.preventDefault();
        var selectedQuestionId = $(this).data('id');
        var selectedQuestionText = $(this).text();
        var selectedTeacherId = $('#teacherDropdown').val(); 

        if (!selectedQuestionId || !selectedTeacherId) {
            return;
        }

        $('#dropdownMenuButton').text(selectedQuestionText);
        $('#responseList .list-group-item span').text('0%');
        $('#totalRespondents').text('Total Respondents: 0');

        $.ajax({
            url: `reports/get-answers/${selectedTeacherId}/${selectedQuestionId}`, 
            type: 'GET',
            success: function (data) {
                console.log("Fetched data:", data); 
                fetchedData = data; 
                let chartData = [0, 0, 0, 0, 0];  
                let totalResponses = data.answers.length; 

                const departmentDropdown = $('#departmentDropdownMenu'); 
                departmentDropdown.empty(); 
                if (data.departments && data.departments.length > 0) {
                    data.departments.forEach(function (department) {
                        departmentDropdown.append('<li><a class="dropdown-item" href="#" data-name="' + department + '">' + department + '</a></li>');
                    });
                } else {
                    departmentDropdown.append('<li><a class="dropdown-item" href="#">No departments available.</a></li>');
                }

                data.answers.forEach(answer => {
                    if (answer.answer >= 1 && answer.answer <= 5) {
                        chartData[answer.answer - 1]++;
                    }
                });

                updateChart(chartData);
                $('#totalRespondents').text(`Total Respondents: ${totalResponses}`);
                
                $('#responseList .list-group-item').each(function (index) {
                    let percentage = totalResponses ? Math.round((chartData[index] / totalResponses) * 100) : 0;
                    $(this).find('span').text(percentage + '%');
                });
            },
            error: function (xhr, status, error) {
                $('#totalRespondents').text('Error loading answers.');
                console.error("Error loading answers:", error);
            }
        });

        // Update chart function
        function updateChart(data) {
            trafficChart.data.datasets[0].data = data; 
            trafficChart.options.elements.arc.borderWidth = 2; 

            const allZero = data.every(value => value === 0);
            if (allZero) {
                trafficChart.data.datasets[0].borderColor = 'rgba(0, 0, 0, 0.2)'; 
                trafficChart.data.datasets[0].backgroundColor = ['rgba(255, 255, 255, 0.5)']; 
            } else {
                trafficChart.data.datasets[0].borderColor = [
                    '#A4D07B', 
                    '#B1D490',
                    '#BED8A5', 
                    '#CBECC0', 
                    '#D9F0D2',
                ]; 
            }

            trafficChart.update(); 
        }
    });

// Department dropdown item click event
$(document).on('click', '#departmentDropdownMenu .dropdown-item', function (event) {
    event.preventDefault();
    const selectedDepartmentName = $(this).text();
    $('#departmentDropdownButton').text(selectedDepartmentName);
    
    // Use the previously fetched data
    if (fetchedData) {
        populateYearProgressBars(fetchedData.yearCounts);
        populateBlockProgressBars(fetchedData.blockCounts); // Call to populate block progress bars
    } else {
        alert('No data available for the selected question or teacher.');
    }
});

// Function to populate year progress bars
function populateYearProgressBars() {
    if (!fetchedData) {
        console.error("No fetched data available.");
        return;
    }

    console.log("Using fetched data for year progress bars:", fetchedData);

    // Here we can directly use fetchedData.yearCounts
    updateProgressBars(fetchedData.yearCounts); // Call the function to update progress bars with actual counts
}

// Function to update progress bars with actual counts
function updateProgressBars(yearData) {
    // Clear previous year progress bars
    $('#yearProgressBars').empty();

    // Use direct year labels as they appear in your data
    const years = ['First', 'Second', 'Third', 'Fourth'];

    // Create a row for the progress bars
    const progressRow = $('<div class="row"></div>');

    years.forEach((year) => {
        const count = yearData[year] || 0;

        // Calculate the percentage based on the total number of responses
        const percentage = Math.min(count, 100);

        // Create a progress bar for each year
        const progressBar = `
            <div class="col mb-4">
                <div class="progress" style="height: 30px;">
                    <div class="progress-bar" role="progressbar" style="width: ${percentage}%;"
                         aria-valuenow="${percentage}" aria-valuemin="0" aria-valuemax="100">
                        ${count}
                    </div>
                </div>
                <div class="text-center">${year} Year</div>
            </div>
        `;
        
        // Append the progress bar to the progress row
        progressRow.append(progressBar);
    });

    // Append the entire row of progress bars to the container
    $('#yearProgressBars').append(progressRow);
}

function populateBlockProgressBars(blockData) {
    if (!blockData) {
        console.error("No block data available.");
        return;
    }

    console.log("Using fetched data for block progress bars:", blockData);
    
    updateBlockProgressBars(blockData); // Call the function to update block progress bars with actual counts
}

// Function to update block progress bars with actual counts
function updateBlockProgressBars(blockData) {
    // Clear previous block progress bars
    $('#blockProgressBars').empty();

    // Create a row for the progress bars
    const progressRow = $('<div class="row"></div>');

    // Assume blockData is an object where keys are block names and values are counts
    const blocks = ["Block 1", "Block 2", "Block 3", "Block 4", "Block 5", "Block 6", "Block 7", "Block 8", "Block 9", "Block 10"];
    
    blocks.forEach((block) => {
        const count = blockData[block] || 0; // Get the count based on block name

        // Calculate the percentage based on the total number of responses
        const percentage = Math.min(count, 100);

        // Create a progress bar for each block
        const progressBar = `
            <div class="col mb-4">
                <div class="progress" style="height: 30px;">
                    <div class="progress-bar" role="progressbar" style="width: ${percentage}%;"
                         aria-valuenow="${percentage}" aria-valuemin="0" aria-valuemax="100">
                        ${count}
                    </div>
                </div>
                <div class="text-center">${block}</div> <!-- Display block name -->
            </div>
        `;
        
        // Append the progress bar to the progress row
        progressRow.append(progressBar);
    });

    // Append the entire row of progress bars to the container
    $('#blockProgressBars').append(progressRow);
}


});
</script>


</body>

</html>
