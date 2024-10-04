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

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
@include('sidebar')

<div class="container-fluid" style="height: 100vh;"> 
    <div class="row justify-content-center">
        <div class="col-md-8" style="margin: 0 auto;"> 
            <div class="py-2" style="margin-top: 20px;"> 
                <div class="max-w-7xl mx-auto sm:px-2 lg:px-4">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-2 text-gray-900 fs-7">
                            <div class="d-flex align-items-center justify-content-between"> 
                                <h1 class="mb-0">Student List</h1>
                            </div>
                            <hr />
                            @if(Session::has('success'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('success') }}
                            </div>
                            @endif
                            <div class="table-responsive" style="max-width: 800px;"> 
                                <table class="table table-sm table-hover table-borderless align-middle">
                                    <thead class="table-primary">
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
                                    <tbody>
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
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="#" class="btn btn-outline-secondary">Edit</a>
                                                    <a href="#" class="btn btn-outline-danger">Delete</a>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
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

</body>
</html>