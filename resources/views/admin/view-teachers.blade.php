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
    <a class="nav-link-students" aria-current="page" href="{{ route('view-student') }}">
        <i class="fas fa-user-graduate"></i>
        Student
    </a>
</li>
<li class="nav-item">
    <a class="nav-link-teachers active" href="{{ route('view-teachers') }}">
        <i class="fas fa-chalkboard-teacher"></i>
        Teachers
    </a>
</li>

            </ul>
        </div>
    </div>
</nav>


</body>
</html>
