@extends('layouts.master')

@section('title', 'Manage Employees - VIA Architects Associates')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/common/modals.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/manage-employee.css') }}">
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
                                            'email' => $employee->user->email ?? 'N/A',
                                            'phone' => $employee->contact_info ?? 'N/A',
                                            'position' => $employee->position->position_name ?? 'N/A',
                                            'department' => $employee->department->department_name ?? 'N/A',
                                            'salary' => '₱' . number_format($employee->salary_rate ?? $employee->position->basic_salary ?? 0, 2),
                                            'status' => $employee->employment_status ?? 'Regular',
                                            'hire-date' => $employee->hire_date ? \Carbon\Carbon::parse($employee->hire_date)->format('M d, Y') : 'N/A',
                                            'sex' => $employee->sex ?? 'N/A',
                                            'birth' => $employee->date_of_birth ? \Carbon\Carbon::parse($employee->date_of_birth)->format('M d, Y') : 'N/A',
                                            'address' => ($employee->current_street_address ?? '') . ' ' . ($employee->current_barangay ?? '') . ' ' . ($employee->current_city_municipality ?? ''),
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
                        <div class="view-card-icon"><i data-lucide="users"></i></div>
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
            <div class="modal-footer">
                <button type="button" class="btn-modal btn-modal-secondary btn-full" onclick="closeViewModal()">Close Profile</button>
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