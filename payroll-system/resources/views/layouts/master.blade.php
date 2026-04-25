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
    <link rel="stylesheet" href="{{ asset('css/dashboard style/dashboard.css') }}">
    
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
<body>
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
                                <img src="https://ui-avatars.com/api/?name=Admin+User&background=3b82f6&color=ffffff" alt="User" class="h-full w-full object-cover">
                            </div>
                        </div>
                        <div class="profile-info">
                            <p class="profile-name">Admin User</p>
                            <p class="profile-role">Administrator</p>
                        </div>
                        <i data-lucide="chevron-down" class="h-4 w-4 text-slate-500 group-hover:text-blue-500 transition-colors"></i>
                    </button>

                    <!-- Dropdown Menu -->
                    <div id="profile-dropdown" class="dropdown-menu">
                        <div class="dropdown-header">
                            <p class="dropdown-label">Account</p>
                            <p class="dropdown-user-name">Ralph Administrator</p>
                        </div>
                        <a href="{{ route('profile.settings') }}" class="dropdown-item">
                            <i data-lucide="user" class="h-4 w-4 text-slate-500 group-hover:text-blue-500"></i>
                            Profile Settings
                        </a>
                        
                        <button id="theme-toggle" class="dropdown-item">
                            <i data-lucide="moon" class="h-4 w-4 text-slate-500 group-hover:text-blue-500 theme-icon"></i>
                            <span class="theme-text">Dark Mode</span>
                        </button>
                        
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="#">
                            @csrf
                            <button type="submit" class="dropdown-logout">
                                <i data-lucide="log-out" class="h-4 w-4 text-rose-400"></i>
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <div class="dashboard-wrapper">
            <!-- Shared Sidebar -->
            <aside id="sidebar" class="sidebar sidebar-expanded">
                <nav class="sidebar-nav">
                    <button id="sidebar-toggle" class="sidebar-toggle-btn">
                        <i data-lucide="menu" class="h-6 w-6"></i>
                    </button>

                    <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'sidebar-link-active' : '' }}">
                        <i data-lucide="layout-dashboard" class="mr-3.5 h-5 w-5"></i>
                        <span class="sidebar-text">Dashboard</span>
                    </a>

                    <a href="{{ route('employees.create') }}" class="sidebar-link {{ request()->routeIs('employees.create') ? 'sidebar-link-active' : '' }}">
                        <i data-lucide="users" class="mr-3.5 h-5 w-5"></i>
                        <span class="sidebar-text">Employees</span>
                    </a>

                    <a href="#" class="sidebar-link">
                        <i data-lucide="credit-card" class="mr-3.5 h-5 w-5"></i>
                        <span class="sidebar-text">Payroll</span>
                    </a>

                    <a href="#" class="sidebar-link">
                        <i data-lucide="bar-chart-3" class="mr-3.5 h-5 w-5"></i>
                        <span class="sidebar-text">Reports</span>
                    </a>
                </nav>
            </aside>

            <!-- Main Content Area -->
            <main class="main-content">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/Dashboard/dashboard.js') }}"></script>
    @yield('scripts')
</body>
</html>
