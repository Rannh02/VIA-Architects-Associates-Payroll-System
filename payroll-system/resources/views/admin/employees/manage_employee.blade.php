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
                    <tr>
                        <td class="employee-id">E001</td>
                        <td>
                            <div class="employee-name-cell">
                                <span class="employee-avatar">M</span>
                                <div>
                                    <p class="employee-name">Maria Santos</p>
                                    <p class="employee-since">Since 2020-03-15</p>
                                </div>
                            </div>
                        </td>
                        <td class="employee-position">Senior Engineer</td>
                        <td><span class="department-badge badge-engineering">Engineering</span></td>
                        <td class="employee-salary">₱55,000.00</td>
                        <td class="employee-allowance">₱3,000.00</td>
                        <td><span class="status-badge badge-regular">Regular</span></td>
                        <td><a href="#" class="employee-action-link">Edit</a></td>
                    </tr>
                    <tr>
                        <td class="employee-id">E002</td>
                        <td>
                            <div class="employee-name-cell">
                                <span class="employee-avatar">J</span>
                                <div>
                                    <p class="employee-name">Juan dela Cruz</p>
                                    <p class="employee-since">Since 2021-07-01</p>
                                </div>
                            </div>
                        </td>
                        <td class="employee-position">Accountant II</td>
                        <td><span class="department-badge badge-finance">Finance</span></td>
                        <td class="employee-salary">₱38,000.00</td>
                        <td class="employee-allowance">₱2,000.00</td>
                        <td><span class="status-badge badge-regular">Regular</span></td>
                        <td><a href="#" class="employee-action-link">Edit</a></td>
                    </tr>
                    <tr>
                        <td class="employee-id">E003</td>
                        <td>
                            <div class="employee-name-cell">
                                <span class="employee-avatar">A</span>
                                <div>
                                    <p class="employee-name">Ana Reyes</p>
                                    <p class="employee-since">Since 2022-01-10</p>
                                </div>
                            </div>
                        </td>
                        <td class="employee-position">HR Specialist</td>
                        <td><span class="department-badge badge-hr">Human Resources</span></td>
                        <td class="employee-salary">₱32,000.00</td>
                        <td class="employee-allowance">₱1,500.00</td>
                        <td><span class="status-badge badge-regular">Regular</span></td>
                        <td><a href="#" class="employee-action-link">Edit</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection