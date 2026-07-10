<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Admin - Bus Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .sidebar { background-color: #343a40; min-height: 100vh; color: #fff; }
        .sidebar a { color: #adb5bd; text-decoration: none; display: block; padding: 10px 20px; }
        .sidebar a:hover, .sidebar a.active { color: #fff; background-color: #495057; }
        .content-area { padding: 20px; }
        .navbar { background-color: #fff; box-shadow: 0 2px 4px rgba(0,0,0,.08); }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar flex-shrink-0" style="width: 250px;">
            <div class="p-3 text-center border-bottom border-secondary mb-3">
                <img src="{{ asset('images/admin-logo.jpg') }}" alt="Master Admin Logo" class="img-fluid rounded mb-2" style="max-height: 80px;">
                <h5 class="text-white mb-0">Master Admin</h5>
            </div>
            <ul class="list-unstyled">
                <li><a href="{{ route('bus-companies.index') }}" class="active">Bus Companies</a></li>
            </ul>
        </div>
        
        <!-- Main Content -->
        <div class="flex-grow-1">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">
                    <span class="navbar-brand mb-0 h1">Dashboard</span>
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
