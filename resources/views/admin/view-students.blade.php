<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Students Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/css/student.css">
    <link rel="stylesheet" href="/css/nav.css">
    <link rel="icon" href="/src/logow.png">
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
                                        <select class="form-select me-2" id="blockSelect" onchange="filterStudents()">
                                            <option value="">All Blocks</option>
                                            @foreach ($blocks as $block)
                                                <option value="{{ $block }}">{{ $block }}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                   <a href="javascript:void(0)" class="btn btn-add create-student" data-bs-toggle="modal" 
                                   data-bs-target="#addStudentModal" create-student>Add New Student</a>


                                    <a href="{{ route('export-users') }}" class="btn btn-add">Export Data</a>
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
                                                <th>Student ID</th>
                                                <th>Email</th>
                                                <th>First Name</th>
                                                <th>Middle Name</th>
                                                <th>Last Name</th>
                                                <th>Block</th>
                                                <th>Year</th>
                                                <th>Department</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="studentTableBody">
                                            @forelse ($students as $student)
                                            <tr>
                                                <td>{{ $student->student_id }}</td>
                                                <td>{{ $student->email }}</td>
                                                <td>{{ $student->first_name }}</td>
                                                <td>{{ $student->middle_name }}</td>
                                                <td>{{ $student->last_name }}</td>
                                                <td>{{ $student->block }}</td>
                                                <td>{{ $student->year }}</td>
                                                <td>{{ $student->department }}</td>
                                                <td>
                                                    <div class="btn-group-student btn-group-sm" role="group">
                                                    <button class="btn btn-outline-secondary edit-student"
                                                        data-id="{{ $student->id }}"
                                                         data-student-id="{{ $student->student_id }}"
                                                         data-student-email="{{ $student->email }}"
                                                          data-student-first-name="{{ $student->first_name }}"
                                                            data-student-middle-name="{{ $student->middle_name }}"
                                                                data-student-last-name="{{ $student->last_name }}"
                                                            data-student-block="{{ $student->block }}"
                                                            data-student-year="{{ $student->year }}"
                                                            data-student-department="{{ $student->department }}">
                                                            Edit
                                                        </button>

                                                        <a href="{{ route('delete-student', ['id' => $student->id]) }}" 
                                                        class="btn btn-outline-danger" 
                                                        onclick="return confirmDeleteStudent()">Delete</a>

                                                    </div>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="8" class="text-center">No students found</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    {{ $students->links('vendor.pagination.bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

 
    <div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editStudentModalLabel">Edit Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form id="editStudentForm" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" id="editID" name="id">
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">User Type</label>
                                <select name="user_type" class="form-control" id="editUserType">
                                    <option value="student">Student</option>
                                    <option value="admin">Admin</option>
                                </select>
                                @error('user_type')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Student ID</label>
                                <input type="text" id="editStudentID" name="student_id" class="form-control" placeholder="Student ID" readonly>
                                @error('student_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Email</label>
                                <input type="email" id="editStudentEmail" name="email" class="form-control" placeholder="Email">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">First Name</label>
                                <input type="text" id="editStudentFirstName" name="first_name" class="form-control" placeholder="First Name">
                                @error('first_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col">
                                <label class="form-label">Middle Name</label>
                                <input type="text" id="editStudentMiddleName" name="middle_name" class="form-control" placeholder="Middle Name">
                                @error('middle_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col">
                                <label class="form-label">Last Name</label>
                                <input type="text" id="editStudentLastName" name="last_name" class="form-control" placeholder="Last Name">
                                @error('last_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Block</label>
                                <input type="text" id="editStudentBlock" name="block" class="form-control" placeholder="Block">
                                @error('block')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col">
                                <label class="form-label">Year</label>
                                <input type="text" id="editStudentYear" name="year" class="form-control" placeholder="Year">
                                @error('year')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col">
                                <label class="form-label">Department</label>
                                <input type="text" id="editStudentDepartment" name="department" class="form-control" placeholder="Department">
                                @error('department')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update Student</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStudentModalLabel">Add New Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form id="addStudentForm" method="POST" action="{{ route('save-student') }}">
                @csrf
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Student ID</label>
                        <input type="text" id="addStudentID" name="student_id" class="form-control" placeholder="Student ID">
                        @error('student_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Email</label>
                            <input type="email" id="addStudentEmail" name="email" class="form-control" placeholder="Email">
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Password</label>
                            <input type="password" id="addStudentPassword" name="password" class="form-control" placeholder="Password">
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">First Name</label>
                            <input type="text" id="addStudentFirstName" name="first_name" class="form-control" placeholder="First Name">
                            @error('first_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col">
                            <label class="form-label">Middle Name</label>
                            <input type="text" id="addStudentMiddleName" name="middle_name" class="form-control" placeholder="Middle Name">
                            @error('middle_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col">
                            <label class="form-label">Last Name</label>
                            <input type="text" id="addStudentLastName" name="last_name" class="form-control" placeholder="Last Name">
                            @error('last_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Block</label>
                            <input type="text" id="addStudentBlock" name="block" class="form-control" placeholder="Block">
                            @error('block')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col">
                            <label class="form-label">Year</label>
                            <input type="text" id="addStudentYear" name="year" class="form-control" placeholder="Year">
                            @error('year')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col">
                            <label class="form-label">Department</label>
                            <input type="text" id="addStudentDepartment" name="department" class="form-control" placeholder="Department">
                            @error('department')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Student</button>
                    </div>
                </form>
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

function confirmDeleteStudent() {
        return confirm("Are you sure you want to delete this student?");
    }


        document.querySelectorAll('.edit-student').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const studentId = this.getAttribute('data-student-id');
                const email = this.getAttribute('data-student-email');
                const firstName = this.getAttribute('data-student-first-name');
                const middleName = this.getAttribute('data-student-middle-name');
                const lastName = this.getAttribute('data-student-last-name');
                const block = this.getAttribute('data-student-block');
                const year = this.getAttribute('data-student-year');
                const department = this.getAttribute('data-student-department');

                document.getElementById('editID').value = id;
                document.getElementById('editStudentID').value = studentId;
                document.getElementById('editStudentEmail').value = email;
                document.getElementById('editStudentFirstName').value = firstName;
                document.getElementById('editStudentMiddleName').value = middleName;
                document.getElementById('editStudentLastName').value = lastName;
                document.getElementById('editStudentBlock').value = block;
                document.getElementById('editStudentYear').value = year;
                document.getElementById('editStudentDepartment').value = department;

                const editModal = new bootstrap.Modal(document.getElementById('editStudentModal'));
                editModal.show();
            });
        });
        

    document.querySelector('.create-student').addEventListener('click', function() {
    document.getElementById('addStudentID').value = '';
    document.getElementById('addStudentEmail').value = '';
    document.getElementById('addStudentFirstName').value = '';
    document.getElementById('addStudentMiddleName').value = '';
    document.getElementById('addStudentLastName').value = '';
    document.getElementById('addStudentBlock').value = '';
    document.getElementById('addStudentYear').value = '';
    document.getElementById('addStudentDepartment').value = '';
});


document.getElementById("editStudentForm").addEventListener("submit", function(e) {
            e.preventDefault();

            const studentId = document.getElementById("editID").value;

            fetch(`/admin/students/update/${studentId}`, {
             method: "PUT", 
            headers: {
             "X-CSRF-TOKEN": "{{ csrf_token() }}",
              "Content-Type": "application/json",
             },
             body: JSON.stringify(Object.fromEntries(new FormData(this))),
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert("Student updated successfully!");
                    location.reload();
                } else {
                    alert("Failed to update student.");
                }
            })
            .catch(error => {
                console.error("Error:", error);
            });
        });
        
        document.getElementById("addStudentForm").addEventListener("submit", function(e) {
    e.preventDefault();  

    let formData = Object.fromEntries(new FormData(this));

    fetch(`/admin/students/save`, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}", 
            "Content-Type": "application/json"
        },
        body: JSON.stringify(formData)  
    })
    .then(response => {
        if (!response.ok) {
            return response.text().then(text => {
                console.error('Response text:', text); 
                throw new Error('Failed to create student: ' + text);
            });
        }
        return response.json();
    })
    .then(data => {
      
        alert('Student created successfully');
        window.location.reload();  
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred: ' + error.message);
    });
});




        



        

       
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
