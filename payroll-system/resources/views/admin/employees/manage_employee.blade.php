@extends('layouts.master')

@section('title', 'Manage Employees - VIA Architects Associates')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/manage-employee.css') }}">
    <style>
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.4);
            backdrop-filter: blur(4px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            transition: all 0.2s ease-out;
        }
        .modal-overlay.show {
            display: flex;
            opacity: 1;
        }
        .modal-content {
            background: white;
            width: 95%;
            max-width: 440px;
            border-radius: 1rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            transform: scale(0.95);
            transition: all 0.2s ease-out;
            border: 1px solid #e2e8f0;
            overflow: hidden;
        }
        .modal-overlay.show .modal-content {
            transform: scale(1);
        }
        .modal-inner {
            padding: 1.5rem;
        }
        .modal-top {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            margin-bottom: 1.25rem;
        }
        .modal-icon-container {
            flex-shrink: 0;
            width: 2.75rem;
            height: 2.75rem;
            background: #fee2e2;
            color: #dc2626;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .modal-info {
            flex: 1;
        }
        .modal-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 0.375rem;
        }
        .modal-description {
            color: #64748b;
            font-size: 0.875rem;
            line-height: 1.5;
        }
        .modal-footer {
            background: #f8fafc;
            padding: 1rem 1.5rem;
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
            border-top: 1px solid #e2e8f0;
        }
        .btn-modal {
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: 600;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.15s;
            border: 1px solid transparent;
        }
        .btn-modal-secondary {
            background: white;
            border-color: #e2e8f0;
            color: #475569;
        }
        .btn-modal-secondary:hover {
            background: #f1f5f9;
            border-color: #cbd5e1;
        }
        .btn-modal-danger {
            background: #dc2626;
            color: white;
        }
        .btn-modal-danger:hover {
            background: #b91c1c;
        }

        /* View Modal - Enterprise Redesign */
        .modal-content-view {
            max-width: 750px;
            width: 95%;
            border: none;
            background: #f8fafc;
        }
        .view-modal-header {
            background: white;
            padding: 2rem;
            color: #0f172a;
            display: flex;
            align-items: center;
            gap: 1.5rem;
            position: relative;
            border-bottom: 1px solid #e2e8f0;
        }
        .view-header-avatar {
            width: 80px;
            height: 80px;
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            border-radius: 1.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: 800;
            color: #3b82f6;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            z-index: 1;
        }
        .view-header-info { z-index: 1; }
        .view-header-name {
            font-size: 1.5rem;
            font-weight: 800;
            margin-bottom: 0.25rem;
            letter-spacing: -0.025em;
            color: #0f172a;
        }
        .view-header-title {
            font-size: 0.875rem;
            color: #64748b;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .view-modal-close-btn {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: white;
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            z-index: 50;
        }
        .view-modal-close-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: rotate(90deg);
        }
        .view-modal-close-btn i {
            width: 1.25rem;
            height: 1.25rem;
        }
        .view-modal-body {
            padding: 1.5rem;
            max-height: 65vh;
            overflow-y: auto;
        }
        .view-section-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.25rem;
            margin-bottom: 1.5rem;
        }
        .view-card {
            background: white;
            padding: 1rem;
            border-radius: 0.75rem;
            border: 1px solid #e2e8f0;
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            transition: all 0.2s;
        }
        .view-card:hover {
            border-color: #3b82f6;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }
        .view-card-icon {
            width: 2.25rem;
            height: 2.25rem;
            background: #eff6ff;
            color: #3b82f6;
            border-radius: 0.625rem;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .view-card-icon i { width: 1.125rem; height: 1.125rem; }
        .view-card-content { flex: 1; }
        .view-card-label {
            font-size: 0.7rem;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.125rem;
        }
        .view-card-value {
            font-size: 0.875rem;
            font-weight: 600;
            color: #0f172a;
        }
        .section-divider {
            grid-column: span 2;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin: 0.75rem 0 0.25rem 0;
        }
        .section-divider span {
            font-size: 0.7rem;
            font-weight: 800;
            color: #3b82f6;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            white-space: nowrap;
        }
        .section-line {
            height: 1px;
            background: #e2e8f0;
            flex: 1;
        }
        
        /* Dark Mode Overrides */
        .dark-mode .modal-content {
            background: #1e293b;
            border-color: #334155;
        }
        .dark-mode .modal-inner { background: #1e293b; }
        .dark-mode .modal-title { color: #f8fafc; }
        .dark-mode .modal-description { color: #94a3b8; }
        .dark-mode .modal-footer { background: #0f172a; border-color: #334155; }
        .dark-mode .modal-icon-container { background: rgba(220, 38, 38, 0.1); }
        .dark-mode .btn-modal-secondary { background: #1e293b; border-color: #334155; color: #f8fafc; }
        .dark-mode .btn-modal-secondary:hover { background: #334155; }

        .dark-mode .modal-content-view { background: #0f172a; border-color: #1e293b; }
        .dark-mode .modal-content-view .modal-footer { background: #0f172a; border-color: #1e293b; }
        .dark-mode .view-card { background: #1e293b; border-color: #334155; }
        .dark-mode .view-card-icon { background: rgba(59, 130, 246, 0.1); color: #60a5fa; }
        .dark-mode .view-card-label { color: #94a3b8; }
        .dark-mode .view-card-value { color: #f8fafc; }
        .dark-mode .section-line { background: #334155; }
        .dark-mode .view-modal-header {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border-bottom-color: #1e293b;
            color: white;
        }
        .dark-mode .view-header-name { color: white; }
        .dark-mode .view-header-title { color: #94a3b8; }
        .dark-mode .view-header-avatar { background: #1e293b; color: #60a5fa; border-color: #334155; }
        .dark-mode .view-modal-close-btn { background: rgba(255, 255, 255, 0.05); color: #94a3b8; }
        .dark-mode .view-modal-close-btn:hover { background: rgba(255, 255, 255, 0.1); color: white; }
    </style>
@endsection

@section('content')
    <div class="max-w-6xl mx-auto">
        <div class="content-header">
            <div>
                <h2 class="header-title">Manage Employees</h2>
                <p class="header-subtitle">
                    <span class="subtitle-dot"></span>
                    Search, filter, and manage your employee records.
                </p>
            </div>
            <div style="display: flex; gap: 1rem;">
                <a href="{{ route('employees.archived') }}" class="btn-secondary" style="display: flex; align-items: center; gap: 0.5rem; background: white; border: 1px solid #e2e8f0; padding: 0.625rem 1.25rem; border-radius: 0.75rem; font-weight: 600; color: #64748b; transition: all 0.2s;">
                    <i data-lucide="archive" class="h-4 w-4"></i>
                    View Archives
                </a>
                <a href="{{ route('employees.create') }}" class="btn-primary" style="display: flex; align-items: center; gap: 0.5rem; background: #3b82f6; color: white; padding: 0.625rem 1.25rem; border-radius: 0.75rem; font-weight: 600; box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.2); transition: all 0.2s;">
                    <i data-lucide="user-plus" class="h-4 w-4"></i>
                    Add New Employee
                </a>
            </div>
        </div>

        <div class="employee-search-container">
            <div class="employee-search-input-wrapper">
                <!-- <i data-lucide="search" ></i> -->
                <input type="text" placeholder="Search employees..." class="employee-search-input" />
            </div>
            <div class="employee-department-select">
                <select>
                    <option>All Departments</option>
                    <option>Engineering</option>
                    <option>Finance</option>
                    <option>Human Resources</option>
                    <option>Sales</option>
                    <option>Marketing</option>
                </select>
            </div>
        </div>

        @if(session('success'))
            <div style="background:#d1fae5;color:#065f46;border:1px solid #6ee7b7;padding:12px 16px;border-radius:8px;margin-bottom:16px;display:flex;align-items:center;gap:8px;">
                <i data-lucide="check-circle" class="h-4 w-4"></i> {{ session('success') }}
            </div>
        @endif

        <div class="employee-table-container">
            <table class="employee-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Department</th>
                        <th>Salary</th>
                        <th>Allowance</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employees as $employee)
                    <tr>
                        <td class="employee-id">{{ $employee->employee_number ?? 'E' . str_pad($employee->employee_id, 3, '0', STR_PAD_LEFT) }}</td>
                        <td>
                            <div class="employee-name-cell">
                                <img src="{{ $employee->photo_url }}" alt="" class="employee-avatar" style="object-fit: cover;">
                                <div>
                                    <p class="employee-name">{{ $employee->first_name }} {{ $employee->last_name }}</p>
                                    <p class="employee-since">Since {{ $employee->hire_date ? \Carbon\Carbon::parse($employee->hire_date)->format('Y-m-d') : 'N/A' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="employee-position">{{ $employee->position->position_name ?? 'N/A' }}</td>
                        <td>
                            <span class="department-badge badge-{{ strtolower(str_replace(' ', '-', $employee->department->department_name ?? 'none')) }}">
                                {{ $employee->department->department_name ?? 'N/A' }}
                            </span>
                        </td>
                        <td class="employee-salary">₱{{ number_format($employee->salary_rate ?? $employee->position->basic_salary ?? 0, 2) }}</td>
                        <td class="employee-allowance">₱0.00</td>
                        <td>
                            <span class="status-badge badge-{{ strtolower($employee->employment_status ?? 'regular') }}">
                                {{ $employee->employment_status ?? 'Regular' }}
                            </span>
                        </td>
                        <td>
                            <div class="employee-action-group">
                                <button type="button" 
                                        class="employee-action-link action-view"
                                        onclick="openViewModal({{ json_encode([
                                            'db_id' => $employee->employee_id,
                                            'id' => $employee->employee_number ?? 'E' . str_pad($employee->employee_id, 3, '0', STR_PAD_LEFT),
                                            'name' => $employee->first_name . ' ' . $employee->last_name,
                                            'photo_url' => $employee->photo_url,
                                            'email' => $employee->email ?? 'N/A',
                                            'phone' => $employee->phone ?? 'N/A',
                                            'position' => $employee->position->position_name ?? 'N/A',
                                            'department' => $employee->department->department_name ?? 'N/A',
                                            'salary' => '₱' . number_format($employee->salary_rate ?? $employee->position->basic_salary ?? 0, 2),
                                            'status' => $employee->employment_status ?? 'Regular',
                                            'hire_date' => $employee->hire_date ? \Carbon\Carbon::parse($employee->hire_date)->format('M d, Y') : 'N/A',
                                            'sex' => $employee->sex ?? 'N/A',
                                            'birth' => $employee->date_of_birth ? \Carbon\Carbon::parse($employee->date_of_birth)->format('M d, Y') : 'N/A',
                                            'address' => ($employee->current_street_address ?? '') . ' ' . ($employee->current_barangay ?? '') . ' ' . ($employee->current_city ?? ''),
                                            'sss' => $employee->sss_num ?? 'N/A',
                                            'philhealth' => $employee->philhealth_num ?? 'N/A',
                                            'pagibig' => $employee->pagibig_num ?? 'N/A'
                                        ]) }})">
                                    View
                                </button>
                                <a href="{{ route('employees.edit', $employee->employee_id) }}" class="employee-action-link action-edit">Edit</a>
                                <button type="button" 
                                        class="employee-action-link action-archive" 
                                        onclick="openArchiveModal('{{ $employee->employee_id }}', '{{ $employee->first_name }} {{ $employee->last_name }}')">
                                    Archive
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 20px; color: #6b7280;">No employees found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Archive Confirmation Modal -->
    <div id="archive-modal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-inner">
                <div class="modal-top">
                    <div class="modal-icon-container">
                        <i data-lucide="alert-triangle" class="h-6 w-6"></i>
                    </div>
                    <div class="modal-info">
                        <h3 class="modal-title">Archive Employee</h3>
                        <p class="modal-description">
                            Are you sure you want to archive <strong id="employee-name-display" style="color: inherit; font-weight: 700;"></strong>? 
                            This will move them to the archived list and they will no longer appear in active payroll runs.
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-modal btn-modal-secondary" onclick="closeArchiveModal()">Cancel</button>
                <form id="archive-form" method="POST" style="margin: 0;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-modal btn-modal-danger">Archive Employee</button>
                </form>
            </div>
        </div>
    </div>

    <div id="view-modal" class="modal-overlay">
        <div class="modal-content modal-content-view">
            <div class="view-modal-header">
                <div class="view-header-avatar-container">
                    <img id="view-header-avatar-img" src="" alt="" class="view-header-avatar hidden" style="object-fit: cover;">
                    <div class="view-header-avatar" id="view-header-avatar-initial">?</div>
                </div>
                <div class="view-header-info">
                    <h2 class="view-header-name" id="view-header-name">Employee Name</h2>
                    <div class="view-header-title">
                        <i data-lucide="briefcase" class="h-4 w-4"></i>
                        <span id="view-header-position">Position Title</span>
                        <span style="opacity: 0.3;">•</span>
                        <span id="view-header-id">ID: ---</span>
                    </div>
                </div>
                <button type="button" class="view-modal-close-btn" onclick="closeViewModal()">
                    <i data-lucide="x"></i>
                </button>
            </div>

            <div class="view-modal-body">
                <div class="view-section-grid">
                    <div class="section-divider">
                        <span>Personal Information</span>
                        <div class="section-line"></div>
                    </div>
                    
                    <div class="view-card">
                        <div class="view-card-icon"><i data-lucide="user"></i></div>
                        <div class="view-card-content">
                            <p class="view-card-label">Full Name</p>
                            <p class="view-card-value" id="view-name">---</p>
                        </div>
                    </div>
                    <div class="view-card">
                        <div class="view-card-icon"><i data-lucide="mail"></i></div>
                        <div class="view-card-content">
                            <p class="view-card-label">Email Address</p>
                            <p class="view-card-value" id="view-email">---</p>
                        </div>
                    </div>
                    <div class="view-card">
                        <div class="view-card-icon"><i data-lucide="phone"></i></div>
                        <div class="view-card-content">
                            <p class="view-card-label">Phone Number</p>
                            <p class="view-card-value" id="view-phone">---</p>
                        </div>
                    </div>
                    <div class="view-card">
                        <div class="view-card-icon"><i data-lucide="venus-mars"></i></div>
                        <div class="view-card-content">
                            <p class="view-card-label">Sex</p>
                            <p class="view-card-value" id="view-sex">---</p>
                        </div>
                    </div>
                    <div class="view-card">
                        <div class="view-card-icon"><i data-lucide="calendar"></i></div>
                        <div class="view-card-content">
                            <p class="view-card-label">Date of Birth</p>
                            <p class="view-card-value" id="view-birth">---</p>
                        </div>
                    </div>
                    <div class="view-card">
                        <div class="view-card-icon"><i data-lucide="map-pin"></i></div>
                        <div class="view-card-content">
                            <p class="view-card-label">Address</p>
                            <p class="view-card-value" id="view-address">---</p>
                        </div>
                    </div>

                    <div class="section-divider">
                        <span>Employment Details</span>
                        <div class="section-line"></div>
                    </div>
                    
                    <div class="view-card">
                        <div class="view-card-icon"><i data-lucide="award"></i></div>
                        <div class="view-card-content">
                            <p class="view-card-label">Department</p>
                            <p class="view-card-value" id="view-department">---</p>
                        </div>
                    </div>
                    <div class="view-card">
                        <div class="view-card-icon"><i data-lucide="dollar-sign"></i></div>
                        <div class="view-card-content">
                            <p class="view-card-label">Monthly Salary</p>
                            <p class="view-card-value" id="view-salary">---</p>
                        </div>
                    </div>
                    <div class="view-card">
                        <div class="view-card-icon"><i data-lucide="shield-check"></i></div>
                        <div class="view-card-content">
                            <p class="view-card-label">Employment Status</p>
                            <p class="view-card-value" id="view-status">---</p>
                        </div>
                    </div>
                    <div class="view-card">
                        <div class="view-card-icon"><i data-lucide="calendar-check"></i></div>
                        <div class="view-card-content">
                            <p class="view-card-label">Hire Date</p>
                            <p class="view-card-value" id="view-hire-date">---</p>
                        </div>
                    </div>

                    <div class="section-divider">
                        <span>Government Identifiers</span>
                        <div class="section-line"></div>
                    </div>
                    
                    <div class="view-card">
                        <div class="view-card-icon"><i data-lucide="fingerprint"></i></div>
                        <div class="view-card-content">
                            <p class="view-card-label">SSS Number</p>
                            <p class="view-card-value" id="view-sss">---</p>
                        </div>
                    </div>
                    <div class="view-card">
                        <div class="view-card-icon"><i data-lucide="heart"></i></div>
                        <div class="view-card-content">
                            <p class="view-card-label">PhilHealth</p>
                            <p class="view-card-value" id="view-philhealth">---</p>
                        </div>
                    </div>
                    <div class="view-card">
                        <div class="view-card-icon"><i data-lucide="home"></i></div>
                        <div class="view-card-content">
                            <p class="view-card-label">Pag-IBIG</p>
                            <p class="view-card-value" id="view-pagibig">---</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding: 1.25rem 1.5rem;">
                <button type="button" class="btn-modal btn-modal-secondary px-8" onclick="closeViewModal()" style="width: 100%;">Close Profile</button>
            </div>
        </div>
    </div>

    <script>
        function openArchiveModal(id, name) {
            const modal = document.getElementById('archive-modal');
            const form = document.getElementById('archive-form');
            const nameDisplay = document.getElementById('employee-name-display');
            
            form.action = `/employees/${id}`;
            nameDisplay.textContent = name;
            
            modal.classList.add('show');
            if (window.lucide) window.lucide.createIcons();
        }

        function closeArchiveModal() {
            document.getElementById('archive-modal').classList.remove('show');
        }

        window.openViewModal = function(data) {
            const modal = document.getElementById('view-modal');
            
            // Populate Avatar and Header
            const avatarImg = document.getElementById('view-header-avatar-img');
            const avatarInitial = document.getElementById('view-header-avatar-initial');
            
            if (data.photo_url && !data.photo_url.includes('ui-avatars.com')) {
                avatarImg.src = data.photo_url;
                avatarImg.classList.remove('hidden');
                avatarInitial.classList.add('hidden');
            } else {
                avatarImg.classList.add('hidden');
                avatarInitial.classList.remove('hidden');
                avatarInitial.textContent = data.name.charAt(0).toUpperCase();
            }
            
            document.getElementById('view-header-name').textContent = data.name;
            document.getElementById('view-header-position').textContent = data.position;
            document.getElementById('view-header-id').textContent = `ID: ${data.id}`;
            
            // Populate Cards
            for (const key in data) {
                const el = document.getElementById(`view-${key}`);
                if (el) el.textContent = data[key];
            }
            modal.classList.add('show');
            if (window.lucide) window.lucide.createIcons();
        }

        function closeViewModal() {
            document.getElementById('view-modal').classList.remove('show');
        }

        window.onclick = function(event) {
            const archiveModal = document.getElementById('archive-modal');
            const viewModal = document.getElementById('view-modal');
            if (event.target == archiveModal) closeArchiveModal();
            if (event.target == viewModal) closeViewModal();
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeArchiveModal();
                closeViewModal();
            }
        });
    </script>
@endsection