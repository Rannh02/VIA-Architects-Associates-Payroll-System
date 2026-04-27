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
<body class="bg-slate-50 dark:bg-slate-900 transition-colors duration-300" style="height: auto !important; overflow: visible !important;">
    <!-- Architectural Background Overlay -->
    <div class="bg-architectural-overlay" style="position: fixed;"></div>

    <div class="min-h-screen flex flex-col relative z-10">
        <!-- Top Navbar -->
        <header class="nav-header">
            <div class="brand-container">
                <div class="brand-logo-box bg-teal-400 text-slate-950 h-10 w-10 flex items-center justify-center rounded-lg font-bold">VIA</div>
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
                                <img src="{{ Auth::user()->profile_photo_url }}" alt="User" class="h-full w-full object-cover">
                            </div>
                        </div>
                        <div class="profile-info">
                            <p class="profile-name">{{ Auth::user()->name }}</p>
                            <p class="profile-role">Employee</p>
                        </div>
                        <i data-lucide="chevron-down" class="h-4 w-4 text-slate-500"></i>
                    </button>

                    <!-- Dropdown Menu -->
                    <div id="profile-dropdown" class="dropdown-menu">
                        <div class="dropdown-header">
                            <p class="dropdown-label">Account</p>
                            <p class="dropdown-user-name">{{ Auth::user()->name }}</p>
                        </div>
                        <a href="#" class="dropdown-item">
                            <i data-lucide="calendar" class="h-4 w-4"></i>
                            View Attendance
                        </a>
                        <a href="{{ route('profile.settings') }}" class="dropdown-item">
                            <i data-lucide="user" class="h-4 w-4"></i>
                            My Profile
                        </a>
                        <a href="#" class="dropdown-item">
                            <i data-lucide="lock" class="h-4 w-4"></i>
                            Change Password
                        </a>
                        <a href="#" class="dropdown-item">
                            <i data-lucide="file-text" class="h-4 w-4"></i>
                            Term & Condition
                        </a>
                        
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-logout">
                                <i data-lucide="log-out" class="h-4 w-4"></i>
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1 p-6 md:p-8">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script>
        lucide.createIcons();

        const profileBtn = document.getElementById('profile-btn');
        const profileDropdown = document.getElementById('profile-dropdown');
        if (profileBtn && profileDropdown) {
            profileBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                profileDropdown.classList.toggle('show');
            });
            window.addEventListener('click', () => {
                profileDropdown.classList.remove('show');
            });
        }
    </script>
    @yield('scripts')
</body>
</html>
