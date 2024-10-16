<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="/css/sidebar.css">

<div class="sidebar d-flex flex-column align-items-center">
    <div class="text-center mb-3">
        <img src="/src/logow.png" alt="Logo" class="sidebar-logo">
    </div>

    <a href="{{ route('admin.dashboard') }}" class="sidebar-link text-center {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" style="color: white !important;">
        <div class="icon-container">
            <div class="icon-underline"></div>
            <i class="fas fa-home fa-2x"></i>
        </div>
    </a>

    <a href="{{ route('show-questions') }}" class="sidebar-link text-center {{ request()->routeIs('questionnaire') ? 'active' : '' }}" style="color:white !important;">
        <i class="fas fa-question-circle fa-2x"></i>
    </a>

    <a href="{{ route('view-student') }}" class="sidebar-link text-center {{ request()->routeIs('view-student') ? 'active' : '' }}" style="color: white !important;">
        <i class="fas fa-table fa-2x"></i>
    </a>

    <a href="{{ route('admin-reports') }}" class="sidebar-link text-center {{ request()->is('results') ? 'active' : '' }}" style="color: white !important;">
        <i class="fas fa-chart-pie fa-2x"></i>
    </a>

    <div class="text-center mb-3">
        <a href="#" class="sidebar-link text-center {{ request()->is('logout') ? 'active' : '' }}" id="logout-link" style="color: white !important;">
            <i class="fas fa-sign-out-alt fa-2x"></i>
        </a>
        <form method="POST" action="{{ route('logout') }}" style="display: none;" id="logout-form">
            @csrf
        </form>
    </div>
</div>


<script>
    document.getElementById('logout-link').addEventListener('click', function(event) {
        event.preventDefault(); 
        document.getElementById('logout-form').submit(); 
    });
</script>
