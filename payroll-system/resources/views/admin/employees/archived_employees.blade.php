@extends('layouts.master')

@section('title', 'Archived Employees - VIA Architects Associates')

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
            background: #dcfce7;
            color: #16a34a;
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
        .btn-modal-success {
            background: #16a34a;
            color: white;
        }
        .btn-modal-success:hover {
            background: #15803d;
        }
    </style>
@endsection

@section('content')
    <div class="max-w-6xl mx-auto">
        <div class="content-header">
            <div>
                <h2 class="header-title">Archived Employees</h2>
                <p class="header-subtitle">
                    <span class="subtitle-dot"></span>
                    Manage and restore archived employee records.
                </p>
            </div>
            <div>
                <a href="{{ route('employees.index') }}" class="btn-secondary" style="display: flex; align-items: center; gap: 0.5rem; background: white; border: 1px solid #e2e8f0; padding: 0.625rem 1.25rem; border-radius: 0.75rem; font-weight: 600; color: #64748b; transition: all 0.2s;">
                    <i data-lucide="users" class="h-4 w-4"></i>
                    Back to Active Employees
                </a>
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
                        <th>Hire Date</th>
                        <th>Archived Date</th>
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
                                </div>
                            </div>
                        </td>
                        <td class="employee-position">{{ $employee->position->position_name ?? 'N/A' }}</td>
                        <td>
                            <span class="department-badge badge-{{ strtolower(str_replace(' ', '-', $employee->department->department_name ?? 'none')) }}">
                                {{ $employee->department->department_name ?? 'N/A' }}
                            </span>
                        </td>
                        <td>{{ $employee->hire_date ? \Carbon\Carbon::parse($employee->hire_date)->format('Y-m-d') : 'N/A' }}</td>
                        <td style="color: #ef4444; font-weight: 600;">{{ $employee->deleted_at->format('Y-m-d') }}</td>
                        <td>
                            <div class="employee-action-group">
                                <button type="button" 
                                        class="employee-action-link action-edit" 
                                        style="color: #16a34a;"
                                        onclick="openRestoreModal('{{ $employee->employee_id }}', '{{ $employee->first_name }} {{ $employee->last_name }}')">
                                    Restore
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 40px; color: #64748b;">
                            <div style="display: flex; flex-direction: column; align-items: center; gap: 1rem;">
                                <i data-lucide="archive" class="h-12 w-12 opacity-20"></i>
                                <p>No archived employees found.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Restore Confirmation Modal -->
    <div id="restore-modal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-inner">
                <div class="modal-top">
                    <div class="modal-icon-container">
                        <i data-lucide="rotate-ccw" class="h-6 w-6"></i>
                    </div>
                    <div class="modal-info">
                        <h3 class="modal-title">Restore Employee</h3>
                        <p class="modal-description">
                            Are you sure you want to restore <strong id="employee-name-display" style="color: inherit; font-weight: 700;"></strong>? 
                            They will be moved back to the active employee list.
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-modal btn-modal-secondary" onclick="closeRestoreModal()">Cancel</button>
                <form id="restore-form" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="btn-modal btn-modal-success">Restore Employee</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openRestoreModal(id, name) {
            const modal = document.getElementById('restore-modal');
            const form = document.getElementById('restore-form');
            const nameDisplay = document.getElementById('employee-name-display');
            
            form.action = `/employees/${id}/restore`;
            nameDisplay.textContent = name;
            
            modal.classList.add('show');
            if (window.lucide) window.lucide.createIcons();
        }

        function closeRestoreModal() {
            document.getElementById('restore-modal').classList.remove('show');
        }

        window.onclick = function(event) {
            const restoreModal = document.getElementById('restore-modal');
            if (event.target == restoreModal) closeRestoreModal();
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeRestoreModal();
            }
        });
    </script>
@endsection
