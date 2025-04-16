<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - ServiceHub</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #d81b60;
            --secondary-color: #333;
            --light-gray: #f5f5f5;
            --dark-gray: #666;
            --white: #fff;
            --border-radius: 8px;
            --box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-gray);
        }
        
        .admin-sidebar {
            background-color: var(--secondary-color);
            color: var(--white);
            height: 100vh;
            position: fixed;
            width: 250px;
            padding-top: 20px;
            overflow-y: auto;
        }
        
        .admin-sidebar-brand {
            padding: 0 20px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }
        
        .admin-sidebar-brand img {
            height: 40px;
            margin-right: 10px;
        }
        
        .admin-sidebar-brand h1 {
            font-size: 18px;
            font-weight: 600;
            margin: 0;
            color: var(--white);
        }
        
        .admin-sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .admin-sidebar-menu li {
            margin-bottom: 5px;
        }
        
        .admin-sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .admin-sidebar-menu a:hover,
        .admin-sidebar-menu a.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--white);
        }
        
        .admin-sidebar-menu i {
            margin-right: 10px;
            font-size: 18px;
        }
        
        .admin-content {
            margin-left: 250px;
            padding: 20px;
        }
        
        .admin-header {
            background-color: var(--white);
            padding: 15px 20px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .admin-header h1 {
            font-size: 24px;
            font-weight: 600;
            margin: 0;
        }
        
        .admin-user-dropdown {
            position: relative;
        }
        
        .admin-user-dropdown-toggle {
            display: flex;
            align-items: center;
            cursor: pointer;
        }
        
        .admin-user-dropdown-toggle img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }
        
        .admin-user-dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 10px 0;
            min-width: 200px;
            z-index: 1000;
            display: none;
        }
        
        .admin-user-dropdown-menu.show {
            display: block;
        }
        
        .admin-user-dropdown-menu a {
            display: block;
            padding: 8px 20px;
            color: var(--secondary-color);
            text-decoration: none;
        }
        
        .admin-user-dropdown-menu a:hover {
            background-color: var(--light-gray);
        }
        
        .card {
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            border: none;
            margin-bottom: 20px;
        }
        
        .card-header {
            background-color: var(--white);
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            padding: 15px 20px;
        }
        
        .card-body {
            padding: 20px;
        }
        
        .dashboard-icon {
            width: 60px;
            height: 60px;
            background-color: rgba(216, 27, 96, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .dashboard-icon i {
            font-size: 30px;
            color: var(--primary-color);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: #c2185b;
            border-color: #c2185b;
        }
        
        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        @media (max-width: 991px) {
            .admin-sidebar {
                width: 70px;
                padding-top: 10px;
            }
            
            .admin-sidebar-brand {
                padding: 0 10px 10px;
                justify-content: center;
            }
            
            .admin-sidebar-brand img {
                margin-right: 0;
            }
            
            .admin-sidebar-brand h1 {
                display: none;
            }
            
            .admin-sidebar-menu a {
                padding: 12px;
                justify-content: center;
            }
            
            .admin-sidebar-menu i {
                margin-right: 0;
                font-size: 20px;
            }
            
            .admin-sidebar-menu span {
                display: none;
            }
            
            .admin-content {
                margin-left: 70px;
            }
        }
    </style>
</head>
<body>
    <!-- Admin Sidebar -->
    <div class="admin-sidebar">
        <div class="admin-sidebar-brand">
            <img src="{{ asset('images/logox.png') }}" alt="ServiceHub">
            <h1>Admin Panel</h1>
        </div>
        
        <ul class="admin-sidebar-menu">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.services') }}" class="{{ request()->routeIs('admin.services') ? 'active' : '' }}">
                    <i class="bi bi-tools"></i>
                    <span>Services</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.categories') }}" class="{{ request()->routeIs('admin.categories') ? 'active' : '' }}">
                    <i class="bi bi-grid"></i>
                    <span>Categories</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="bi bi-people"></i>
                    <span>Users</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="bi bi-calendar-check"></i>
                    <span>Bookings</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="bi bi-credit-card"></i>
                    <span>Payments</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="bi bi-gear"></i>
                    <span>Settings</span>
                </a>
            </li>
        </ul>
    </div>
    
    <!-- Admin Content -->
    <div class="admin-content">
        <!-- Admin Header -->
        <div class="admin-header">
            <h1>Admin Dashboard</h1>
            
            <div class="admin-user-dropdown">
                <div class="admin-user-dropdown-toggle" id="userDropdown">
                    <img src="{{ asset('images/admin-avatar.jpeg') }}" alt="Admin User">
                    <div>
                        <div class="fw-bold">Admin User</div>
                        <div class="small text-muted">Administrator</div>
                    </div>
                </div>
                
                <div class="admin-user-dropdown-menu" id="userDropdownMenu">
                    <a href="#">
                        <i class="bi bi-person me-2"></i> Profile
                    </a>
                    <a href="#">
                        <i class="bi bi-gear me-2"></i> Settings
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                    </a>
                    
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        @yield('content')
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // User dropdown toggle
            const userDropdown = document.getElementById('userDropdown');
            const userDropdownMenu = document.getElementById('userDropdownMenu');
            
            userDropdown.addEventListener('click', function() {
                userDropdownMenu.classList.toggle('show');
            });
            
            // Close dropdown when clicking outside
            document.addEventListener('click', function(event) {
                if (!userDropdown.contains(event.target) && !userDropdownMenu.contains(event.target)) {
                    userDropdownMenu.classList.remove('show');
                }
            });
        });
    </script>
</body>
</html>
