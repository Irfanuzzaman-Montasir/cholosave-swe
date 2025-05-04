<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Group Admin')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            overflow-x: hidden;
        }
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            background: white;
            color: #333;
            width: 16rem;
            transition: all 0.3s ease-in-out;
            z-index: 1000;
        }
        .sidebar .nav-link {
            color: #4B5563;
            padding: 0.8rem 1rem;
            margin: 0.2rem 0;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            transition: all 0.2s ease;
        }
        .sidebar .nav-link:hover {
            background: #F3F4F6;
            color: #059669;
        }
        .sidebar .nav-link i {
            width: 20px;
            margin-right: 10px;
            transition: transform 0.2s ease;
            color: #4B5563;
        }
        .sidebar .nav-link:hover i {
            transform: scale(1.1);
            color: #059669;
        }
        .sidebar .nav-link.active {
            background: #F3F4F6;
            color: #059669;
        }
        .main-content {
            margin-left: 16rem;
            padding: 2rem;
            min-height: 100vh;
            transition: margin-left 0.3s ease-in-out;
            background-color: #F9FAFB;
            color: #333;
        }
        .profile-section {
            padding: 1rem;
            border-bottom: 1px solid #E5E7EB;
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .profile-avatar {
            width: 3rem;
            height: 3rem;
            background: linear-gradient(to right, #4ade80, #3b82f6);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .profile-avatar i {
            font-size: 1.5rem;
            color: white;
        }
        .profile-info {
            display: flex;
            flex-direction: column;
        }
        .profile-name {
            font-weight: 600;
            color: #1F2937;
        }
        .profile-role {
            font-size: 0.75rem;
            color: #6B7280;
        }
        .sidebar-section-title {
            font-size: 0.75rem;
            color: #b0b3b8;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 1.2rem 0 0.5rem 1rem;
        }
        .sidebar .nav-link.text-danger {
            color: #ff4d4f !important;
        }
        .sidebar .nav-link.text-danger:hover {
            background: #2d1a1a;
            color: #ff4d4f !important;
        }
        .theme-toggle {
            padding: 1rem;
            border-top: 1px solid #E5E7EB;
        }
        .theme-toggle button {
            width: 100%;
            padding: 0.5rem;
            border-radius: 0.5rem;
            background: transparent;
            color: #4B5563;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: background 0.2s ease;
        }
        .theme-toggle button:hover {
            background: #F3F4F6;
        }
        .nav-scroll {
            overflow-y: auto;
            height: calc(100vh - 8rem);
        }
        .nav-scroll::-webkit-scrollbar {
            width: 4px;
        }
        .nav-scroll::-webkit-scrollbar-track {
            background: transparent;
        }
        .nav-scroll::-webkit-scrollbar-thumb {
            background: #E2E8F0;
            border-radius: 2px;
        }
        .nav-scroll::-webkit-scrollbar-thumb:hover {
            background: #CBD5E0;
        }

        /* Dark mode styles */
        .dark-mode .sidebar {
            background-color: #1a1a1a;
            color: #ffffff;
        }
        .dark-mode .sidebar .nav-link {
            color: #E2E8F0;
        }
        .dark-mode .sidebar .nav-link:hover {
            background-color: #2d3748;
        }
        .dark-mode .sidebar .nav-link i {
            color: #E2E8F0;
        }
        .dark-mode .border-t,
        .dark-mode .border-b {
            border-color: #2d3748;
        }
        .dark-mode .profile-name {
            color: #E2E8F0;
        }
        .dark-mode .profile-role {
            color: #A0AEC0;
        }
        .dark-mode .theme-toggle button {
            color: #E2E8F0;
        }
        .dark-mode .theme-toggle button:hover {
            background-color: #2d3748;
        }
        .dark-mode .main-content {
            background-color: #1a1a1a;
            color: #ffffff;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <!-- Profile Section -->
        <div class="profile-section">
            <div class="profile-avatar">
                <i class="fas fa-user"></i>
            </div>
            <div class="profile-info">
                <span class="profile-name">Test</span>
                <span class="profile-role">Group Admin</span>
            </div>
        </div>
        <div class="nav-scroll">
            <ul class="nav flex-column px-3 py-2">
                <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-chart-line"></i>Dashboard</a></li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-bell"></i>Activity alert</a></li>
                <div class="sidebar-section-title">Financial Management</div>
                <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-hand-holding-dollar"></i>Loans <i class="fas fa-chevron-down ms-auto"></i></a></li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-credit-card"></i>Payments <i class="fas fa-chevron-down ms-auto"></i></a></li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-piggy-bank"></i>Investments <i class="fas fa-chevron-down ms-auto"></i></a></li>
                <div class="sidebar-section-title">Group Management</div>
                <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-users"></i>Members</a></li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-calendar-day"></i>Leave <i class="fas fa-chevron-down ms-auto"></i></a></li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-wallet"></i>Withdraw <i class="fas fa-chevron-down ms-auto"></i></a></li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-comments"></i>Chats</a></li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-poll"></i>Polls <i class="fas fa-chevron-down ms-auto"></i></a></li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-user-plus"></i>Join Request</a></li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-cogs"></i>Settings</a></li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="fa-solid fa-file-lines"></i>Generate Report</a></li>
                <li class="nav-item"><a href="{{ route('home') }}" class="nav-link text-danger"><i class="fas fa-sign-out-alt"></i>Exit</a></li>
            </ul>
        </div>
        <div class="theme-toggle">
            <button id="themeToggle">
                <i class="fas fa-moon"></i>
                <span>Dark Mode</span>
            </button>
        </div>
    </div>
    <div class="main-content">
        @yield('content')
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const themeToggle = document.getElementById('themeToggle');
            const themeIcon = themeToggle.querySelector('i');
            const themeText = themeToggle.querySelector('span');
            let isDarkMode = localStorage.getItem('darkMode') === 'true';
            updateTheme();
            themeToggle.addEventListener('click', () => {
                isDarkMode = !isDarkMode;
                localStorage.setItem('darkMode', isDarkMode);
                updateTheme();
            });
            function updateTheme() {
                if (isDarkMode) {
                    document.body.classList.add('dark-mode');
                    themeIcon.classList.replace('fa-moon', 'fa-sun');
                    themeText.textContent = 'Light Mode';
                } else {
                    document.body.classList.remove('dark-mode');
                    themeIcon.classList.replace('fa-sun', 'fa-moon');
                    themeText.textContent = 'Dark Mode';
                }
            }
        });
    </script>
</body>
</html>
