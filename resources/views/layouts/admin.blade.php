<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Panel - CholoSave')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @stack('styles')

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            background: white;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .sidebar-header {
            padding: 1.5rem 1rem;
            border-bottom: 1px solid #eee;
        }

        .sidebar-header h3 {
            color: #0ea5e9;
            margin: 0;
            font-size: 1.25rem;
            font-weight: 600;
        }

        .sidebar-menu {
            padding: 1rem 0;
        }

        .menu-item {
            padding: 0.75rem 1.5rem;
            color: #64748b;
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .menu-item:hover, .menu-item.active {
            color: #0ea5e9;
            background-color: #f0f9ff;
        }

        .menu-item i {
            width: 20px;
            margin-right: 10px;
        }

        .submenu {
            padding-left: 2.5rem;
            display: none;
        }

        .submenu.show {
            display: block;
        }

        .menu-item[aria-expanded="true"] .fa-chevron-right {
            transform: rotate(90deg);
        }

        .content-wrapper {
            margin-left: 250px;
            padding: 2rem;
            min-height: 100vh;
        }

        /* Dark Mode Toggle */
        .dark-mode-toggle {
            position: fixed;
            bottom: 1rem;
            left: 1rem;
            padding: 0.75rem 1.5rem;
            color: #64748b;
            text-decoration: none;
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .dark-mode-toggle:hover {
            color: #0ea5e9;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .content-wrapper {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h3>Admin Panel</h3>
        </div>
        <div class="sidebar-menu">
            <a href="{{ route('admin.dashboard') }}" class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-chart-line"></i>
                Dashboard
            </a>
            
            <a href="#expertSubmenu" class="menu-item" data-bs-toggle="collapse" aria-expanded="false">
                <i class="fas fa-user-tie"></i>
                Expert Team
                <i class="fas fa-chevron-right ms-auto"></i>
            </a>
            <div class="collapse submenu" id="expertSubmenu">
                <a href="{{ route('admin.experts.create') }}" class="menu-item">
                    <i class="fas fa-plus"></i>
                    Add Expert
                </a>
                <a href="{{ route('admin.experts.index') }}" class="menu-item">
                    <i class="fas fa-edit"></i>
                    Edit Expert
                </a>
            </div>

            <a href="{{ route('admin.contacts.index') }}" class="menu-item {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                <i class="fas fa-envelope"></i>
                Contact Us
            </a>

            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="menu-item w-100 text-start border-0 bg-transparent">
                    <i class="fas fa-sign-out-alt"></i>
                    Log Out
                </button>
            </form>
        </div>

        <div class="dark-mode-toggle">
            <i class="fas fa-moon me-2"></i>
            Dark Mode
        </div>
    </div>

    <!-- Main Content -->
    <div class="content-wrapper">
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Dark Mode Toggle
        const darkModeToggle = document.querySelector('.dark-mode-toggle');
        darkModeToggle.addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');
            // You can add more dark mode logic here
        });

        // Mobile Sidebar Toggle
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('show');
        }
    </script>
    @stack('scripts')
</body>
</html> 