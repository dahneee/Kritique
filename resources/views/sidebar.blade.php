<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/css/sidebar.css">

    
<div class="sidebar d-flex flex-column align-items-center">
    <div class="text-center mb-3">
        <h3 class="mt-2">Kritique</h3> 
    </div>
    <div class="text-center mb-3">
        <h5 class="mt-1" style="color: black !important; opacity: 0;">Zaisuki</h5>
    </div>
    <a href="{{ route('admin.dashboard') }}" class="sidebar-link text-center" style="color: white !important;">
        <i class="fas fa-home fa-2x"></i>
        <span>Dashboard</span>
    </a>

    <a href="{{ route('questionnaire') }}" class="sidebar-link text-center" style="color:white !important;">
        <i class="fas fa-question-circle fa-2x"></i> 
        <span>Questionnaire</span>
    </a>
    <a href="#" class="sidebar-link text-center" style="color: white !important;">
        <i class="fas fa-chart-pie fa-2x"></i>
        <span>Analytics</span>
    </a>
    <a href="#" class="sidebar-link text-center" style="color: white !important;">
        <i class="fas fa-sign-out-alt fa-2x"></i> 
        <span>Logout</span>
    </a>
</div>
