<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - VIA Architects Associates</title>

    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    
    @vite(['resources/css/app.css', 'resources/css/dashboard.css', 'resources/js/app.js'])
    
    <
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

</head>
<body class="h-full overflow-hidden antialiased">
    
    <div class="fixed inset-0 z-0 opacity-20 pointer-events-none" style="background: linear-gradient(135deg, rgba(15, 23, 42, 0.95) 0%, rgba(15, 23, 42, 0.7) 100%), url('/images/login-bg.png'); background-size: cover;"></div>

    <div class="relative flex h-full flex-col z-10">
       
        <header class="glass-panel sticky top-0 z-50 flex h-16 shrink-0 items-center justify-between px-6 border-b border-white/5">
            <div class="flex items-center gap-4">
                <div class="flex h-10 items-center justify-center rounded-lg bg-teal-400 px-4 text-slate-950 font-bold tracking-tight shadow-lg shadow-teal-500/20">
                    VIA
                </div>
                <h1 class="text-xl font-bold text-white tracking-tight">Architects Association</h1>
            </div>
            
            <div class="flex items-center gap-5">
                <button class="relative flex h-10 w-10 items-center justify-center rounded-xl bg-white/5 text-slate-400 hover:bg-white/10 hover:text-teal-400 transition-all border border-white/5">
                    <i data-lucide="bell" class="h-5 w-5"></i>
                    <span class="absolute top-2.5 right-2.5 h-2 w-2 rounded-full bg-rose-500"></span>
                </button>
                
                <!-- Profile Section with Dropdown -->
                <div class="relative">
                    <button id="profile-btn" class="flex items-center gap-3 p-1 pr-3 rounded-xl hover:bg-white/5 transition-all group border border-transparent hover:border-white/10">
                        <div class="h-10 w-10 rounded-xl bg-gradient-to-tr from-teal-400 to-emerald-500 p-0.5 shadow-lg group-hover:scale-105 transition-transform">
                            <div class="h-full w-full rounded-[10px] bg-slate-900 flex items-center justify-center overflow-hidden">
                                <img src="https://ui-avatars.com/api/?name=Admin+User&background=2dd4bf&color=0f172a" alt="User" class="h-full w-full object-cover">
                            </div>
                        </div>
                        <div class="hidden md:block text-left leading-none">
                            <p class="text-sm font-bold text-white">Admin User</p>
                            <p class="text-[10px] text-slate-400 font-medium uppercase tracking-wider mt-0.5">Administrator</p>
                        </div>
                        <i data-lucide="chevron-down" class="h-4 w-4 text-slate-500 group-hover:text-teal-400 transition-colors"></i>
                    </button>

                    <!-- Dropdown Menu -->
                    <div id="profile-dropdown" class="absolute right-0 mt-3 w-56 origin-top-right rounded-2xl bg-slate-900 p-2 shadow-2xl border border-white/10 hidden transform scale-95 opacity-0 transition-all duration-200 z-50">
                        <div class="px-4 py-3 border-b border-white/5 mb-1">
                            <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest">Account</p>
                            <p class="text-sm font-bold text-white truncate mt-1">Ralph Administrator</p>
                        </div>
                        <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-slate-300 rounded-xl hover:bg-white/5 hover:text-teal-400 transition-all group">
                            <i data-lucide="user" class="h-4 w-4 text-slate-500 group-hover:text-teal-400"></i>
                            Profile Settings
                        </a>
                        <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-slate-300 rounded-xl hover:bg-white/5 hover:text-teal-400 transition-all group">
                            <i data-lucide="settings" class="h-4 w-4 text-slate-500 group-hover:text-teal-400"></i>
                            System Config
                        </a>
                        <div class="h-px bg-white/5 my-1"></div>
                        <form method="POST" action="#">
                            @csrf
                            <button type="submit" class="flex w-full items-center gap-3 px-4 py-3 text-sm font-bold text-rose-400 rounded-xl hover:bg-rose-500/10 transition-all group text-left">
                                <i data-lucide="log-out" class="h-4 w-4 text-rose-400"></i>
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <div class="flex flex-1 overflow-hidden">
            <!-- Sidebar -->
            <aside id="sidebar" class="sidebar-transition sidebar-expanded relative flex flex-col border-r border-white/5 bg-slate-900/50 backdrop-blur-xl z-40">
                <div class="flex flex-1 flex-col overflow-y-auto pt-5 pb-4">
                    <nav class="mt-2 flex-1 space-y-1.5 px-4">
                        <button id="sidebar-toggle" class="mb-8 flex h-10 w-10 items-center justify-center rounded-xl text-slate-500 hover:bg-white/5 hover:text-teal-400 transition-all border border-transparent hover:border-white/5">
                            <i data-lucide="menu" class="h-6 w-6"></i>
                        </button>

                        <a href="#" class="group flex items-center rounded-xl px-4 py-3.5 text-sm font-bold bg-teal-400/10 text-teal-400 border-l-4 border-teal-400 shadow-lg shadow-teal-500/5 transition-all">
                            <i data-lucide="layout-dashboard" class="mr-3.5 h-5 w-5 group-hover:scale-110 transition-transform"></i>
                            <span class="sidebar-text">Dashboard</span>
                        </a>

                        <a href="#" class="group flex items-center rounded-xl px-4 py-3.5 text-sm font-semibold text-slate-400 hover:bg-white/5 hover:text-teal-400 transition-all">
                            <i data-lucide="users" class="mr-3.5 h-5 w-5 group-hover:scale-110 transition-transform"></i>
                            <span class="sidebar-text">Employees</span>
                        </a>

                        <a href="#" class="group flex items-center rounded-xl px-4 py-3.5 text-sm font-semibold text-slate-400 hover:bg-white/5 hover:text-teal-400 transition-all">
                            <i data-lucide="credit-card" class="mr-3.5 h-5 w-5 group-hover:scale-110 transition-transform"></i>
                            <span class="sidebar-text">Payroll</span>
                        </a>

                        <a href="#" class="group flex items-center rounded-xl px-4 py-3.5 text-sm font-semibold text-slate-400 hover:bg-white/5 hover:text-teal-400 transition-all">
                            <i data-lucide="bar-chart-3" class="mr-3.5 h-5 w-5 group-hover:scale-110 transition-transform"></i>
                            <span class="sidebar-text">Reports</span>
                        </a>
                    </nav>
                </div>

                <div class="p-4">
                    <div class="rounded-2xl glass-panel p-4 border border-white/5 sidebar-text">
                        <div class="flex items-center gap-2 mb-2">
                            <div class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">System Status</p>
                        </div>
                        <p class="text-sm font-bold text-white">Online & Secure</p>
                    </div>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto p-8 relative">
                <div class="max-w-7xl mx-auto">
                    <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 gap-4">
                        <div>
                            <h2 class="text-3xl font-extrabold text-white tracking-tight">Dashboard Overview</h2>
                            <p class="text-slate-400 mt-2 font-medium flex items-center gap-2">
                                <span class="h-1.5 w-1.5 rounded-full bg-teal-400"></span>
                                Welcome back, Administrator! Here's your current payroll summary.
                            </p>
                        </div>
                        <div class="flex items-center gap-3">
                            <button class="flex items-center gap-2 px-4 py-2.5 bg-white/5 border border-white/10 rounded-xl text-sm font-bold text-white hover:bg-white/10 transition-all">
                                <i data-lucide="calendar" class="h-4 w-4 text-teal-400"></i>
                                Last 30 Days
                            </button>
                            <button class="flex items-center gap-2 px-5 py-2.5 bg-teal-400 text-slate-950 rounded-xl text-sm font-bold hover:bg-teal-500 transition-all shadow-lg shadow-teal-500/20">
                                <i data-lucide="plus" class="h-4 w-4"></i>
                                New Report
                            </button>
                        </div>
                    </div>

                    <!-- Stats Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                        <div class="glass-panel p-6 rounded-3xl hover:border-teal-400/30 hover:bg-white/[0.05] hover:-translate-y-1 transition-all group">
                            <div class="flex items-center justify-between mb-6">
                                <div class="p-3 bg-teal-400/10 rounded-2xl text-teal-400 group-hover:bg-teal-400 group-hover:text-slate-950 transition-all">
                                    <i data-lucide="users" class="h-6 w-6"></i>
                                </div>
                                <span class="text-xs font-bold text-emerald-400 bg-emerald-500/10 px-2.5 py-1.5 rounded-xl border border-emerald-500/20">+12.5%</span>
                            </div>
                            <h3 class="text-slate-500 text-xs font-bold tracking-widest uppercase">Total Employees</h3>
                            <p class="text-3xl font-black text-white mt-1">156</p>
                        </div>

                        <div class="glass-panel p-6 rounded-3xl hover:border-teal-400/30 hover:bg-white/[0.05] hover:-translate-y-1 transition-all group">
                            <div class="flex items-center justify-between mb-6">
                                <div class="p-3 bg-indigo-500/10 rounded-2xl text-indigo-400 group-hover:bg-indigo-500 group-hover:text-white transition-all">
                                    <i data-lucide="banknote" class="h-6 w-6"></i>
                                </div>
                                <span class="text-xs font-bold text-teal-400 bg-teal-400/10 px-2.5 py-1.5 rounded-xl border border-teal-400/20">Active</span>
                            </div>
                            <h3 class="text-slate-500 text-xs font-bold tracking-widest uppercase">Payroll Processed</h3>
                            <p class="text-3xl font-black text-white mt-1">98.2%</p>
                        </div>

                        <div class="glass-panel p-6 rounded-3xl hover:border-teal-400/30 hover:bg-white/[0.05] hover:-translate-y-1 transition-all group">
                            <div class="flex items-center justify-between mb-6">
                                <div class="p-3 bg-amber-500/10 rounded-2xl text-amber-400 group-hover:bg-amber-500 group-hover:text-white transition-all">
                                    <i data-lucide="clock" class="h-6 w-6"></i>
                                </div>
                                <span class="text-xs font-bold text-amber-400 bg-amber-500/10 px-2.5 py-1.5 rounded-xl border border-amber-500/20">Pending</span>
                            </div>
                            <h3 class="text-slate-500 text-xs font-bold tracking-widest uppercase">Pending Approvals</h3>
                            <p class="text-3xl font-black text-white mt-1">24</p>
                        </div>

                        <div class="glass-panel p-6 rounded-3xl hover:border-teal-400/30 hover:bg-white/[0.05] hover:-translate-y-1 transition-all group">
                            <div class="flex items-center justify-between mb-6">
                                <div class="p-3 bg-rose-500/10 rounded-2xl text-rose-400 group-hover:bg-rose-500 group-hover:text-white transition-all">
                                    <i data-lucide="file-text" class="h-6 w-6"></i>
                                </div>
                                <span class="text-xs font-bold text-slate-400 bg-white/5 px-2.5 py-1.5 rounded-xl border border-white/5">Weekly</span>
                            </div>
                            <h3 class="text-slate-500 text-xs font-bold tracking-widest uppercase">Reports Generated</h3>
                            <p class="text-3xl font-black text-white mt-1">42</p>
                        </div>
                    </div>

                    <!-- Content Area Placeholder -->
                    <div class="glass-panel rounded-[32px] overflow-hidden">
                        <div class="p-8 border-b border-white/5 flex items-center justify-between bg-white/[0.02]">
                            <h3 class="text-xl font-bold text-white">Recent System Activity</h3>
                            <button class="text-sm font-bold text-teal-400 hover:text-white flex items-center gap-2 group transition-all">
                                View History
                                <i data-lucide="arrow-right" class="h-4 w-4 group-hover:translate-x-1 transition-transform"></i>
                            </button>
                        </div>
                        <div class="p-20 flex flex-col items-center justify-center text-center">
                            <div class="h-24 w-24 bg-white/5 rounded-[2.5rem] flex items-center justify-center mb-8 border border-white/5">
                                <i data-lucide="layout" class="h-12 w-12 text-slate-600"></i>
                            </div>
                            <h4 class="text-2xl font-bold text-white mb-3">No activity found</h4>
                            <p class="text-slate-400 font-medium max-w-sm mx-auto">Detailed logs and payroll events will be displayed here as the system processes employee data.</p>
                            <button class="mt-10 px-8 py-3.5 bg-white/5 border border-white/10 text-white rounded-2xl font-bold hover:bg-white/10 hover:border-teal-400/30 transition-all">
                                Refresh Data Feed
                            </button>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Initialize Lucide icons with error handling
        try {
            lucide.createIcons();
        } catch (e) {
            console.error('Lucide icons failed to load:', e);
        }

        // Sidebar Toggle Logic
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const sidebarTexts = document.querySelectorAll('.sidebar-text');
        let isSidebarCollapsed = false;

        sidebarToggle.addEventListener('click', () => {
            isSidebarCollapsed = !isSidebarCollapsed;
            if (isSidebarCollapsed) {
                sidebar.classList.remove('sidebar-expanded');
                sidebar.classList.add('sidebar-collapsed');
                sidebarTexts.forEach(text => text.style.display = 'none');
            } else {
                sidebar.classList.remove('sidebar-collapsed');
                sidebar.classList.add('sidebar-expanded');
                sidebarTexts.forEach(text => text.style.display = 'block');
            }
        });

        // Profile Dropdown Logic
        const profileBtn = document.getElementById('profile-btn');
        const profileDropdown = document.getElementById('profile-dropdown');
        let isDropdownOpen = false;

        const closeDropdown = () => {
            profileDropdown.classList.remove('scale-100', 'opacity-100');
            profileDropdown.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                profileDropdown.classList.add('hidden');
            }, 200);
            isDropdownOpen = false;
        };

        profileBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            isDropdownOpen = !isDropdownOpen;
            if (isDropdownOpen) {
                profileDropdown.classList.remove('hidden');
                setTimeout(() => {
                    profileDropdown.classList.remove('scale-95', 'opacity-0');
                    profileDropdown.classList.add('scale-100', 'opacity-100');
                }, 10);
            } else {
                closeDropdown();
            }
        });

        // Close dropdown when clicking outside
        window.addEventListener('click', () => {
            if (isDropdownOpen) closeDropdown();
        });
    </script>
</body>
</html>
