<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'VIA Architects Associates')</title>

    <!-- Modern Typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/common/dashboard.css') }}">
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    
    @yield('styles')

    <!-- Theme Initialization Script -->
    <script>
        (function() {
            const theme = localStorage.getItem('theme') || 'light';
            if (theme === 'dark') {
                document.documentElement.classList.add('dark-mode');
            }
        })();
    </script>
</head>
<body class="bg-slate-50 dark:bg-slate-900 transition-colors duration-300">
    <!-- Architectural Background Overlay -->
    <div class="bg-architectural-overlay"></div>

    <div class="dashboard-layout">
        <!-- Top Navbar -->
        <header class="nav-header">
            <div class="brand-container">
                <div class="brand-logo-box">VIA</div>
                <h1 class="brand-title">Architects Association</h1>
            </div>
            
            <div class="nav-actions">
                <button class="icon-btn">
                    <i data-lucide="bell" class="h-5 w-5"></i>
                    <span class="notification-dot"></span>
                </button>
                
                <!-- Profile Section -->
                <div class="profile-container">
                    <button id="profile-btn" class="profile-trigger">
                        <div class="profile-avatar-gradient">
                            <div class="profile-avatar-inner">
                                <img src="{{ Auth::user()->profile_photo_url }}" alt="User" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        </div>
                        <div class="profile-info">
                            <p class="profile-name">{{ Auth::user()->name }}</p>
                            <p class="profile-role">{{ Auth::user()->role === 'admin' ? 'Administrator' : 'Employee' }}</p>
                        </div>
                        <i data-lucide="chevron-down" class="h-4 w-4 text-slate-500 transition-colors"></i>
                    </button>

                    <!-- Dropdown Menu -->
                    <div id="profile-dropdown" class="dropdown-menu">
                        <div class="dropdown-header">
                            <p class="dropdown-label">Account</p>
                            <p class="dropdown-user-name">{{ Auth::user()->name }}</p>
                        </div>
                        
                        <a href="{{ route('profile.settings') }}" class="dropdown-item">
                            <i data-lucide="user" class="h-4 w-4"></i>
                            Profile Settings
                        </a>

                        <button id="theme-toggle" class="dropdown-item">
                            <i data-lucide="moon" class="h-4 w-4 theme-icon"></i>
                            <span class="theme-text">Dark Mode</span>
                        </button>

                        <div class="dropdown-divider"></div>
                        
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item dropdown-logout" style="color: #f87171; width: 100%; text-align: left; background: none; border: none; cursor: pointer;">
                                <i data-lucide="log-out" class="h-4 w-4"></i>
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <div class="dashboard-wrapper">
            <!-- Sidebar Navigation -->
            <aside id="sidebar" class="sidebar">
                <nav class="sidebar-nav">
                    <button id="sidebar-toggle" class="sidebar-toggle-btn">
                        <i data-lucide="menu" class="h-6 w-6"></i>
                    </button>

                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'sidebar-link-active' : '' }}">
                            <i data-lucide="layout-dashboard" class="h-5 w-5"></i>
                            <span class="sidebar-text">Dashboard</span>
                        </a>
                        <a href="{{ route('employees.create') }}" class="sidebar-link {{ request()->routeIs('employees.create') ? 'sidebar-link-active' : '' }}">
                            <i data-lucide="users" class="h-5 w-5"></i>
                            <span class="sidebar-text">Employees</span>
                        </a>
                        <a href="#" class="sidebar-link">
                            <i data-lucide="banknote" class="h-5 w-5"></i>
                            <span class="sidebar-text">Payroll</span>
                        </a>
                        <a href="#" class="sidebar-link">
                            <i data-lucide="file-bar-chart" class="h-5 w-5"></i>
                            <span class="sidebar-text">Reports</span>
                        </a>
                    @else
                        <a href="{{ route('user.dashboard') }}" class="sidebar-link {{ request()->routeIs('user.dashboard') ? 'sidebar-link-active' : '' }}">
                            <i data-lucide="layout-dashboard" class="h-5 w-5"></i>
                            <span class="sidebar-text">Dashboard</span>
                        </a>
                        <a href="{{ route('user.attendance') }}" class="sidebar-link {{ request()->routeIs('user.attendance') ? 'sidebar-link-active' : '' }}">
                            <i data-lucide="calendar" class="h-5 w-5"></i>
                            <span class="sidebar-text">View Attendance</span>
                        </a>
                    @endif
                </nav>
            </aside>

            <!-- Main Content Container -->
            <main class="main-content">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Initialize Lucide Icons
            lucide.createIcons();

            // Profile Dropdown Toggle
            const profileBtn = document.getElementById('profile-btn');
            const profileDropdown = document.getElementById('profile-dropdown');
            if (profileBtn && profileDropdown) {
                profileBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    profileDropdown.classList.toggle('show');
                });
                profileDropdown.addEventListener('click', (e) => e.stopPropagation());
                window.addEventListener('click', () => profileDropdown.classList.remove('show'));
            }

            // Sidebar Collapse Logic
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebar-toggle');
            const sidebarTexts = document.querySelectorAll('.sidebar-text');
            let isSidebarCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';

            const updateSidebarUI = (collapsed) => {
                sidebar.classList.toggle('sidebar-collapsed', collapsed);
                sidebarTexts.forEach(text => text.style.display = collapsed ? 'none' : 'block');
            };

            if (sidebar && sidebarToggle) {
                updateSidebarUI(isSidebarCollapsed);
                sidebarToggle.addEventListener('click', () => {
                    isSidebarCollapsed = !isSidebarCollapsed;
                    localStorage.setItem('sidebarCollapsed', isSidebarCollapsed);
                    updateSidebarUI(isSidebarCollapsed);
                });
            }

            // Theme Toggle Logic
            const themeToggle = document.getElementById('theme-toggle');
            const themeIcon = document.querySelector('.theme-icon');
            const themeText = document.querySelector('.theme-text');

            const updateThemeUI = (theme) => {
                if (theme === 'dark') {
                    document.documentElement.classList.add('dark-mode');
                    if (themeIcon) themeIcon.setAttribute('data-lucide', 'sun');
                    if (themeText) themeText.textContent = 'Light Mode';
                } else {
                    document.documentElement.classList.remove('dark-mode');
                    if (themeIcon) themeIcon.setAttribute('data-lucide', 'moon');
                    if (themeText) themeText.textContent = 'Dark Mode';
                }
                lucide.createIcons();
            };

            if (themeToggle) {
                themeToggle.addEventListener('click', (e) => {
                    e.stopPropagation(); // Keep dropdown open
                    const isDark = document.documentElement.classList.contains('dark-mode');
                    const newTheme = isDark ? 'light' : 'dark';
                    localStorage.setItem('theme', newTheme);
                    updateThemeUI(newTheme);
                });
                
                // Initialize theme UI
                updateThemeUI(localStorage.getItem('theme') || 'light');
            }
        });
    </script>
    @yield('scripts')
</body>
</html>
