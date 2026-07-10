<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Admin - Bus Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        :root { color-scheme: light; }
        body { background-color: #f8f9fa; }
        .sidebar { background-color: #343a40; min-height: 100vh; color: #fff; }
        .sidebar a { color: #adb5bd; text-decoration: none; display: block; padding: 10px 20px; }
        .sidebar a:hover, .sidebar a.active { color: #fff; background-color: #495057; }
        .content-area { padding: 20px; }
        .navbar { background-color: #fff; box-shadow: 0 2px 4px rgba(0,0,0,.08); }
        /* Force white background for dropdowns */
        .form-select, select.form-select {
            background-color: #ffffff !important;
            color: #000000 !important;
        }
    </style>
</head>
<body>
    <!-- Mobile Navbar with Hamburger -->
    <nav class="navbar navbar-dark bg-dark d-md-none px-3">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="{{ asset('images/admin-logo.jpg') }}" alt="Logo" width="30" height="30" class="d-inline-block align-top rounded me-2">
            Master Admin
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarOffcanvas" aria-controls="sidebarOffcanvas">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

    <div class="d-flex">
        <!-- Sidebar (Visible on Desktop, Offcanvas on Mobile) -->
        <div class="offcanvas-md offcanvas-start sidebar flex-shrink-0" tabindex="-1" id="sidebarOffcanvas" style="width: 250px;">
            <div class="offcanvas-header d-md-none border-bottom border-secondary">
                <h5 class="offcanvas-title text-white">Menu</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" data-bs-target="#sidebarOffcanvas" aria-label="Close"></button>
            </div>
            
            <div class="p-3 text-center border-bottom border-secondary mb-3 d-none d-md-block">
                <img src="{{ asset('images/admin-logo.jpg') }}" alt="Master Admin Logo" class="img-fluid rounded mb-2" style="max-height: 80px;">
                <h5 class="text-white mb-0">Master Admin</h5>
            </div>
            <ul class="list-unstyled">
                <li><a href="#" class=""><i class="bi bi-speedometer2 me-2"></i> Dashboard</a></li>
                <li><a href="{{ route('bus-companies.index') }}" class="{{ request()->routeIs('bus-companies.*') ? 'active' : '' }}"><i class="bi bi-building me-2"></i> Bus Companies</a></li>
                <li><a href="#"><i class="bi bi-signpost-split me-2"></i> Routes & Schedules</a></li>
                <li><a href="#"><i class="bi bi-people me-2"></i> Drivers</a></li>
                <li><a href="#"><i class="bi bi-ticket-perforated me-2"></i> Bookings</a></li>
                <li><a href="#"><i class="bi bi-gear me-2"></i> Settings</a></li>
            </ul>
        </div>
        
        <!-- Main Content -->
        <div class="flex-grow-1 w-100" style="min-width: 0;">
            <!-- Desktop Top Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom d-none d-md-flex px-3">
                <span class="navbar-brand mb-0 h1">Dashboard Overview</span>
                <div class="ms-auto">
                    <span class="text-muted">Admin User</span>
                </div>
            </nav>

            <div class="content-area">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @yield('scripts')
</body>
</html>
