@extends('layouts.master')

@section('title', 'Manage Employees - VIA Architects Associates')

@section('styles')
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
                        <td class="employee-id">E{{ str_pad($employee->employee_id, 3, '0', STR_PAD_LEFT) }}</td>
                        <td>
                            <div class="employee-name-cell">
                                <span class="employee-avatar">{{ strtoupper(substr($employee->first_name, 0, 1)) }}</span>
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
                        <td><a href="#" class="employee-action-link">Edit</a></td>
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
@endsection