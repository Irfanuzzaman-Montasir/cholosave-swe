<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
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
        .history-submenu {
            padding-left: 2rem;
            display: none;
        }
        .history-submenu.show {
            display: block;
        }
        .history-chevron {
            transition: transform 0.2s ease;
        }
        .history-chevron.rotated {
            transform: rotate(180deg);
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
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Profile Section -->
        <div class="profile-section">
            <div class="profile-avatar">
                <i class="fas fa-user"></i>
            </div>
            <div class="profile-info">
                <span class="profile-name">{{ $group->group_name }}</span>
                <span class="profile-role">Group Member</span>
            </div>
        </div>

        <!-- Navigation -->
        <div class="nav-scroll">
            <ul class="nav flex-column px-3 py-2">
                <li class="nav-item">
                    <a href="{{ route('groups.member.dashboard', $group->group_id) }}" class="nav-link">
                        <i class="fas fa-chart-line"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-bell"></i>
                        <span>Activity Alert</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-hand-holding-dollar"></i>
                        <span>Loan Request</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-comments"></i>
                        <span>Chats</span>
                        <span class="badge bg-danger ms-auto" id="unreadCount" style="display: none;">0</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-users"></i>
                        <span>Members</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-credit-card"></i>
                        <span>Payment</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" id="leaveRequestBtn">
                        <i class="fas fa-calendar-day"></i>
                        <span>Leave Request</span>
                    </a>
                </li>

                <!-- History Section -->
                <li class="nav-item">
                    <div class="nav-link" id="historyToggle">
                        <i class="fas fa-history"></i>
                        <span>History</span>
                        <i class="fas fa-chevron-down ms-auto history-chevron"></i>
                    </div>
                    <div class="history-submenu">
                        <a href="#" class="nav-link">
                            <span>Loan History</span>
                        </a>
                        <a href="#" class="nav-link">
                            <span>Payment History</span>
                        </a>
                        <a href="#" class="nav-link">
                            <span>Withdraw History</span>
                        </a>
                    </div>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-wallet"></i>
                        <span>Withdraw Request</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-piggy-bank"></i>
                        <span>Investment Details</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-file-lines"></i>
                        <span>Generate Report</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link text-danger">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Exit</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Theme Toggle -->
        <div class="theme-toggle">
            <button id="themeToggle">
                <i class="fas fa-moon"></i>
                <span>Dark Mode</span>
            </button>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // History submenu toggle
            const historyToggle = document.getElementById('historyToggle');
            const historySubmenu = document.querySelector('.history-submenu');
            const historyChevron = document.querySelector('.history-chevron');

            historyToggle.addEventListener('click', () => {
                historySubmenu.classList.toggle('show');
                historyChevron.classList.toggle('rotated');
            });

            // Theme toggle
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

            // Leave request functionality
            document.getElementById('leaveRequestBtn').addEventListener('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Leave Group',
                    text: 'Are you sure you want to leave this group?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, leave group',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Handle leave request
                        Swal.fire({
                            title: 'Processing...',
                            html: 'Please wait while we process your request',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                    }
                });
            });

            // Check for unread messages
            function checkUnreadMessages() {
                // Implement your message checking logic here
                const unreadCount = document.getElementById('unreadCount');
                // Example: unreadCount.style.display = 'block';
                // unreadCount.textContent = count;
            }

            // Check messages every 30 seconds
            setInterval(checkUnreadMessages, 30000);
            checkUnreadMessages();
        });
    </script>
</body>
</html> 