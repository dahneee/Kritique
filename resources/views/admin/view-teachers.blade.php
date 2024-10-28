<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Teachers Dashboard</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/css/student.css">
    <link rel="stylesheet" href="/css/sidebar.css">
    <link rel="stylesheet" href="/css/nav.css">
    <link rel="icon" href="/src/logow.png">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
@include('sidebar')
<div class="content-teacher">
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
</div>?


<div class="container-tabs">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('view-student') ? 'active' : '' }}" href="{{ route('view-student') }}">
                <i class="fas fa-user-graduate"></i> Student
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('view-teachers') ? 'active' : '' }}" href="{{ route('view-teachers') }}">
                <i class="fas fa-chalkboard-teacher"></i> Teachers
            </a>
        </li>
    </ul>
</div>



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
                                        <input class="form-control sort-search" id="searchInput" type="search" placeholder="Search" aria-label="Search" oninput="filterTeachers()">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-search"></i>
                                        </span>
                                    </div>

                                    <select class="form-select me-2 sort-sort" id="sortSelect" onchange="filterTeachers()">
                                        <option value="teacher_id">Email</option>
                                        <option value="name">Name</option>
                                        <option value="department">Department</option>
                                    </select>
                                </form>
                                <a href="javascript:void(0)" class="btn btn-add create-teacher" data-bs-toggle="modal" 
                                   data-bs-target="#addTeacherModal">Add New Teacher</a>
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
                                                        <a href="{{ route('delete-teacher', ['id'=>$teacher->id]) }}" class="btn btn-outline-danger"
                                                        onclick="return confirmDeleteTeacher()">Delete</a>
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
                                 {{ $teachers->links('vendor.pagination.bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- EDIT TEACHER -->
<div class="modal fade" id="editTeacherModal" tabindex="-1" aria-labelledby="editTeacherModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTeacherModalLabel">Edit Teacher</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editTeacherForm" method="POST" action="{{ route('update-teacher', $teacher->id) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editID" name="id">

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">First Name</label>
                            <input type="text" id="editTeacherFirstName" name="teacher_first_name" class="form-control" placeholder="First Name">
                            @error('teacher_first_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col">
                            <label class="form-label">Middle Name</label>
                            <input type="text" id="editTeacherMiddleName" name="teacher_middle_name" class="form-control" placeholder="Middle Name">
                            @error('teacher_middle_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col">
                            <label class="form-label">Last Name</label>
                            <input type="text" id="editTeacherLastName" name="teacher_last_name" class="form-control" placeholder="Last Name">
                            @error('teacher_last_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Email</label>
                            <input type="email" id="editTeacherEmail" name="email" class="form-control" placeholder="Email">
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <label class="form-label">Department</label>
                        <select id="editTeacherDepartment" name="department" class="form-select"> <!-- Changed from form-control to form-select -->
                            <option value="" disabled selected>Select Department</option> <!-- Added default option for better UX -->
                            @foreach($departments as $department)
                                <option value="{{ $department->department_id }}" 
                                    {{ old('department', $teachers->department ?? '') == $department->department_id ? 'selected' : '' }}>
                                    {{ $department->department_id }}
                                </option>
                            @endforeach
                        </select>
                        @error('department')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Teacher</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add Teacher Modal -->
<div class="modal fade" id="addTeacherModal" tabindex="-1" aria-labelledby="addTeacherModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTeacherModalLabel">Add New Teacher</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addTeacherForm" method="POST" action="{{ route('save-teacher') }}">
                    @csrf
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Email</label>
                            <input type="email" id="addTeacherEmail" name="email" class="form-control" placeholder="Email">
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">First Name</label>
                            <input type="text" id="addTeacherFirstName" name="teacher_first_name" class="form-control" placeholder="First Name">
                            @error('first_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col">
                            <label class="form-label">Middle Name</label>
                            <input type="text" id="addTeacherMiddleName" name="teacher_middle_name" class="form-control" placeholder="Middle Name">
                            @error('middle_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col">
                            <label class="form-label">Last Name</label>
                            <input type="text" id="addTeacherLastName" name="teacher_last_name" class="form-control" placeholder="Last Name">
                            @error('last_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Department</label>
                            <select id="addTeacherDepartment" name="department" class="form-select"> <!-- Changed from form-control to form-select -->
                                <option value="" disabled selected>Select Department</option> <!-- Added default option for better UX -->
                                @foreach($departments as $department)
                                    <option value="{{ $department->department_id }}">{{ $department->department_id }}</option>
                                @endforeach
                            </select>
                            @error('department')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Teacher</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

</body>
<script>
let originalTeacherRows = [];

document.addEventListener('DOMContentLoaded', function() {
    const tableBody = document.getElementById('teacherTableBody');
    const rows = tableBody.querySelectorAll('tr');
    originalTeacherRows = Array.from(rows);
    filterTeachers();
});

function filterTeachers() {
    const searchQuery = document.getElementById('searchInput').value.toLowerCase();
    const sortOption = document.getElementById('sortSelect').value;

    const tableBody = document.getElementById('teacherTableBody');
    let teacherRows = [...originalTeacherRows];

    if (searchQuery !== '') {
        teacherRows = teacherRows.filter(row => {
            const cells = row.querySelectorAll('td');
            const textContent = Array.from(cells).map(cell => cell.textContent.toLowerCase()).join(' ');
            return textContent.includes(searchQuery);
        });
    }

    teacherRows.sort((a, b) => {
        let aValue, bValue;
        if (sortOption === 'teacher_id') {
            aValue = a.querySelector('td:first-child').textContent;
            bValue = b.querySelector('td:first-child').textContent;
        } else if (sortOption === 'name') {
            aValue = a.querySelector('td:nth-child(2)').textContent + a.querySelector('td:nth-child(3)').textContent + a.querySelector('td:nth-child(4)').textContent;
            bValue = b.querySelector('td:nth-child(2)').textContent + b.querySelector('td:nth-child(3)').textContent + b.querySelector('td:nth-child(4)').textContent;
        } else if (sortOption === 'department') {
            aValue = a.querySelector('td:nth-child(5)').textContent;
            bValue = b.querySelector('td:nth-child(5)').textContent;
        }
        return aValue.localeCompare(bValue);
    });

    tableBody.innerHTML = '';
    teacherRows.forEach(row => tableBody.appendChild(row));
}

document.querySelectorAll('.btn-outline-secondary').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();
        
        const id = this.getAttribute('href').split('/').pop(); 
        const row = this.closest('tr');
        
        const email = row.querySelector('td:nth-child(1)').textContent;
        const firstName = row.querySelector('td:nth-child(2)').textContent;
        const middleName = row.querySelector('td:nth-child(3)').textContent;
        const lastName = row.querySelector('td:nth-child(4)').textContent;
        const department = row.querySelector('td:nth-child(5)').textContent;

        document.getElementById('editID').value = id;
        document.getElementById('editTeacherFirstName').value = firstName;
        document.getElementById('editTeacherMiddleName').value = middleName;
        document.getElementById('editTeacherLastName').value = lastName; 
        document.getElementById('editTeacherEmail').value = email;
        document.getElementById('editTeacherDepartment').value = department;

        const editModal = new bootstrap.Modal(document.getElementById('editTeacherModal'));
        editModal.show();
    });
});


                document.querySelector('.create-teacher').addEventListener('click', function() {
                document.getElementById('addTeacherEmail').value = '';
              
                document.getElementById('addTeacherFirstName').value = '';
                document.getElementById('addTeacherMiddleName').value = '';
                document.getElementById('addTeacherLastName').value = '';
                document.getElementById('addTeacherDepartment').value = '';
            });

            document.querySelector('.create-teacher').addEventListener('click', function() {
    document.getElementById('addTeacherForm').reset();
});


document.getElementById("editTeacherForm").addEventListener("submit", function(e) {
    e.preventDefault();

    const teacherId = document.getElementById("editID").value;
    const formData = Object.fromEntries(new FormData(this));

    fetch(`/admin/teachers/update/${teacherId}`, {
        method: "PUT",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
            "Content-Type": "application/json",
            "X-Requested-With": "XMLHttpRequest",
        },
        body: JSON.stringify(formData), // Convert form data to JSON
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(errorData => {
                throw new Error(JSON.stringify(errorData));
            });
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            alert("Teacher updated successfully!");
            location.reload();
        } else {
            alert("Failed to update teacher.");
        }
    })
    .catch(error => {
        console.error("Error:", error);
    });
});


document.getElementById("addTeacherForm").addEventListener("submit", function(e) {
    e.preventDefault();  

    let formData = Object.fromEntries(new FormData(this));

    fetch('/admin/teachers/save', {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
            "Content-Type": "application/json"
        },
        body: JSON.stringify(formData)
    })
    .then(response => {
        if (!response.ok) {
            return response.text().then(text => {
                throw new Error(text);
            });
        }
        return response.json();
    })
    .then(data => {
        alert('Teacher created successfully');
        window.location.reload();
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred: ' + error.message);
    });
});

function confirmDeleteTeacher() {
    return confirm("Are you sure you want to delete this teacher?");
}

</script>

</html>
