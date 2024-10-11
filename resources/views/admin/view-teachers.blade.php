<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/css/student.css">
    <link rel="stylesheet" href="/css/nav.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
@include('sidebar')
<nav class="navbar navbar-expand-lg shadow-sm mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="#" style="color: #A4D07B !important; font-weight: 600;">CRUD Table</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
    <a class="nav-link-students active" aria-current="page" href="{{ route('view-student') }}">
        <i class="fas fa-user-graduate"></i>
        Student
    </a>
</li>
<li class="nav-item">
    <a class="nav-link-teachers" href="{{ route('view-teachers') }}">
        <i class="fas fa-chalkboard-teacher"></i>
        Teachers
    </a>
</li>

            </ul>
        </div>
    </div>
</nav>


<div class="trans-content">
    <div class="row justify-content-center">
        <div class="col-md-10" style="margin: 0 auto;"> 
            <div class="py-2" style="margin-top: 20px;"> 
                <div class="max-w-7xl mx-auto sm:px-2 lg:px-4">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-2 text-gray-900 fs-7">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <form class="d-flex align-items-center" id="filterForm">
                                <div class="input-group">
                                    <input class="form-control" id="searchInput" type="search" placeholder="Search" aria-label="Search" oninput="filterStudents()">
                                     <span class="input-group-text" id="basic-addon1">
                                      <i class="fas fa-search"></i>
                                     </span>
                                </div>

                                    <select class="form-select me-2" id="sortSelect" onchange="filterStudents()">
                                        <option value="student_id">Sort: Student ID</option>
                                        <option value="name">Sort: Name</option>
                                        <option value="department">Sort: Department</option>
                                    </select>
                                
                                </form>
                                <a href="{{ route('create-teacher') }}" class="btn btn-add">Add New Teacher</a>
                                </div>
                                <hr />
                                @if(Session::has('success'))
                                    <div class="alert alert-success" role="alert">
                                        {{ Session::get('success') }}
                                    </div>
                                @endif
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped align-middle">
                                        <thead class="table">
                                            <tr>
                                                <th>Email</th>
                                                <th>First Name</th>
                                                <th>Middle Name</th>
                                                <th>Last Name</th>
                                                <th>Department</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="teacherTableBody">
                                            @forelse ($teachers as $teacher)
                                            <tr>
                                                <td>{{ $teacher->email }}</td>
                                                <td>{{ $teacher->teacher_first_name }}</td>
                                                <td>{{ $teacher->teacher_middle_name }}</td>
                                                <td>{{ $teacher->teacher_last_name }}</td>
                                                <td>{{ $teacher->department }}</td>
                                                <td>
                                                    <div class="btn-group-teacher btn-group-sm" role="group">
                                                        <a href="{{ route('edit-teacher', ['id'=>$teacher->id]) }}" class="btn btn-outline-secondary">Edit</a>
                                                        <a href="{{ route('delete-teacher', ['id'=>$teacher->id]) }}" class="btn btn-outline-danger">Delete</a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="6" class="text-center">No teachers found</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

<script>
let originalStudentRows = [];

document.addEventListener('DOMContentLoaded', function() {
    const tableBody = document.getElementById('studentTableBody');
    const rows = tableBody.querySelectorAll('tr');
    originalStudentRows = Array.from(rows);
    filterStudents();
});

function filterStudents() {
    const searchQuery = document.getElementById('searchInput').value.toLowerCase();
    const sortOption = document.getElementById('sortSelect').value;
    const selectedBlock = document.getElementById('blockSelect').value;

    const tableBody = document.getElementById('studentTableBody');
    let studentRows = [...originalStudentRows];

    if (searchQuery !== '') {
        studentRows = studentRows.filter(row => {
            const cells = row.querySelectorAll('td');
            const textContent = Array.from(cells).map(cell => cell.textContent.toLowerCase()).join(' ');
            return textContent.includes(searchQuery);
        });
    }

    if (selectedBlock !== '') {
        studentRows = studentRows.filter(row => {
            const blockCell = row.querySelector('td:nth-child(6)').textContent;
            return blockCell === selectedBlock;
        });
    }

    studentRows.sort((a, b) => {
        const aText = a.querySelector(`td:nth-child(${getSortColumnIndex(sortOption)})`).textContent.toLowerCase();
        const bText = b.querySelector(`td:nth-child(${getSortColumnIndex(sortOption)})`).textContent.toLowerCase();
        return aText.localeCompare(bText);
    });

    tableBody.innerHTML = '';
    studentRows.forEach(row => tableBody.appendChild(row));
}

function getSortColumnIndex(sortOption) {
    switch (sortOption) {
        case 'student_id':
            return 1;
        case 'name':
            return 3;
        case 'department':
            return 7;
        default:
            return 1;
    }
}
</script>

</body>
</html>
