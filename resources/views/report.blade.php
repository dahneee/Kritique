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
   
</div>

<div class="modal fade" id="studentModal" tabindex="-1" aria-labelledby="studentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="studentModalLabel">Student List</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Email</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Block</th>
                            <th>Department</th>
                        </tr>
                    </thead>
                    <tbody id="studentTableBody">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="teacherModal" tabindex="-1" aria-labelledby="teacherModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="teacherModalLabel">Teacher List</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Department</th>
                        </tr>
                    </thead>
                    <tbody id="teacherTableBody">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

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
                label: 'Total',
                data: [300, 400, 500, 250, 600, 370],
                borderColor: 'rgba(75, 192, 192, 1)',
                fill: false
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const chartP = document.getElementById('projectsChart').getContext('2d');
    const projectsChart = new Chart(chartP, {
        type: 'doughnut',
        data: {
            labels: ['Responded', 'Pending'],
            datasets: [{
                label: 'Respondents',
                data: [70, 30],
                backgroundColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)']
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

    function handleTotalTeachersClick() {
        const teachers = [
            { email: 'alice.johnson@example.com', teacher_first_name: 'Alice', teacher_middle_name: 'M', teacher_last_name: 'Johnson', department: 'Mathematics' },
            { email: 'bob.brown@example.com', teacher_first_name: 'Bob', teacher_middle_name: 'T', teacher_last_name: 'Brown', department: 'Science' },
        ];

        const tableBody = document.getElementById('teacherTableBody');
        tableBody.innerHTML = '';

        teachers.forEach(teacher => {
            const row = `
                <tr>
                    <td>${teacher.email}</td>
                    <td>${teacher.teacher_first_name}</td>
                    <td>${teacher.teacher_middle_name}</td>
                    <td>${teacher.teacher_last_name}</td>
                    <td>${teacher.department}</td>
                </tr>
            `;
            tableBody.innerHTML += row;
        });

        const teacherModal = new bootstrap.Modal(document.getElementById('teacherModal'));
        teacherModal.show();
    }

    function handleTotalStudentsClick() {
        const students = [
            { student_id: 'S001', email: 'jane.doe@example.com', first_name: 'Jane', middle_name: 'A', last_name: 'Doe', block: 'B1', department: 'Mathematics' },
            { student_id: 'S002', email: 'john.smith@example.com', first_name: 'John', middle_name: 'B', last_name: 'Smith', block: 'B2', department: 'Science' },
        ];

        const tableBody = document.getElementById('studentTableBody');
        tableBody.innerHTML = '';

        students.forEach(student => {
            const row = `
                <tr>
                    <td>${student.student_id}</td>
                    <td>${student.email}</td>
                    <td>${student.first_name}</td>
                    <td>${student.middle_name}</td>
                    <td>${student.last_name}</td>
                    <td>${student.block}</td>
                    <td>${student.department}</td>
                </tr>
            `;
            tableBody.innerHTML += row;
        });

        const studentModal = new bootstrap.Modal(document.getElementById('studentModal'));
        studentModal.show();
    }
</script>
</body>
</html>
