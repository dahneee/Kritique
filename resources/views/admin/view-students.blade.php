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
                                        <select class="form-select me-2" id="blockSelect" onchange="filterStudents()">
                                            <option value="">All Blocks</option>
                                            @foreach ($blocks as $block)
                                                <option value="{{ $block }}">{{ $block }}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                    <a href="{{ route('create-student') }}" class="btn btn-add">Add New Student</a>
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
                                                <td>{{ $student->department }}</td>
                                                <td>
                                                    <div class="btn-group-student btn-group-sm" role="group">
                                                        <button class="btn btn-outline-secondary edit-student" data-student-id="{{ $student->id }}" data-student-email="{{ $student->email }}" data-student-first-name="{{ $student->first_name }}" data-student-middle-name="{{ $student->middle_name }}" data-student-last-name="{{ $student->last_name }}" data-student-block="{{ $student->block }}" data-student-department="{{ $student->department }}">Edit</button>
                                                        <a href="{{ route('delete-student', ['id'=>$student->id]) }}" class="btn btn-outline-danger">Delete</a>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Student Modal -->
    <div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editStudentModalLabel">Edit Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editStudentForm">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editStudentID" name="id">

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
                                <input type="text" id="editStudentID" name="student_id" class="form-control" placeholder="Student ID">
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const editButtons = document.querySelectorAll(".edit-student");

            editButtons.forEach(button => {
                button.addEventListener("click", function() {
                    const studentId = this.getAttribute("data-student-id");
                    const studentEmail = this.getAttribute("data-student-email");
                    const studentFirstName = this.getAttribute("data-student-first-name");
                    const studentMiddleName = this.getAttribute("data-student-middle-name");
                    const studentLastName = this.getAttribute("data-student-last-name");
                    const studentBlock = this.getAttribute("data-student-block");
                    const studentDepartment = this.getAttribute("data-student-department");

                    document.getElementById("editStudentID").value = studentId;
                    document.getElementById("editStudentEmail").value = studentEmail;
                    document.getElementById("editStudentFirstName").value = studentFirstName;
                    document.getElementById("editStudentMiddleName").value = studentMiddleName;
                    document.getElementById("editStudentLastName").value = studentLastName;
                    document.getElementById("editStudentBlock").value = studentBlock;
                    document.getElementById("editStudentDepartment").value = studentDepartment;

                    const editStudentModal = new bootstrap.Modal(document.getElementById("editStudentModal"));
                    editStudentModal.show();
                });
            });

            document.getElementById("editStudentForm").addEventListener("submit", function(e) {
                e.preventDefault(); 

                const formData = new FormData(this);
                const studentId = document.getElementById("editStudentID").value;

                fetch(`/update-student/${studentId}`, {
                    method: "PUT",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    body: formData,
                })
                .then(response => response.json())
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
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
