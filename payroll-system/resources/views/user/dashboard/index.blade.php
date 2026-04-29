@extends('layouts.master')

@section('title', 'Employee Portal - VIA Architects Associates')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/user/style.css') }}">
@endsection

@section('content')
    <div class="main-content-inner">
        <div class="content-header">
            <div>
                <h2 class="header-title">Employee Portal</h2>
                <p class="header-subtitle">
                    <span class="subtitle-dot"></span>
                    Welcome back, {{ Auth::user()->name ?? 'User' }} — {{ date('F d, Y') }}
                </p>
            </div>
            <div class="header-actions">
                <button class="btn-secondary">
                    <i data-lucide="clock" class="mr-2 h-4 w-4"></i>
                    Clock In
                </button>

            </div>
        </div>

        <!-- Stats Grid -->
        <div class="stats-grid">
            @php
                $stats = [
                    ['label' => 'Attendance', 'value' => 4, 'icon' => 'user-check', 'color' => 'teal', 'badge' => 'Ontime'],
                    ['label' => 'Abcenses', 'value' => 12, 'icon' => 'user-x', 'color' => 'rose', 'badge' => 'Monthly'],
                    ['label' => 'Late Arrivals', 'value' => 9, 'icon' => 'clock', 'color' => 'amber', 'badge' => 'Cumulative'],
                    ['label' => 'Holiday Off', 'value' => 2, 'icon' => 'sun', 'color' => 'indigo', 'badge' => 'Paid'],
                    ['label' => 'Bereavement', 'value' => 1, 'icon' => 'heart', 'color' => 'slate', 'badge' => 'Leave'],
                ];
            @endphp
            @foreach($stats as $stat)
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon stat-icon-{{ $stat['color'] }}">
                            <i data-lucide="{{ $stat['icon'] }}" class="h-6 w-6"></i>
                        </div>
                        <span
                            class="stat-badge badge-{{ $stat['color'] === 'teal' ? 'teal' : ($stat['color'] === 'rose' ? 'rose' : 'amber') }}">
                            {{ $stat['badge'] }}
                        </span>
                    </div>
                    <h3 class="stat-label">{{ $stat['label'] }}</h3>
                    <p class="stat-value">{{ $stat['value'] }}</p>
                </div>
            @endforeach
        </div>

        <div class="dashboard-grid">
            <!-- Payroll & Attendance Section -->
            <div class="dashboard-column">
                <div class="payroll-card">
                    <div class="payroll-header">
                        <div>
                            <p class="section-label">Payroll Overview</p>
                            <h3 class="section-title">Financial Summary</h3>
                        </div>
                        <button class="btn-view-payroll">
                            <i data-lucide="external-link" class="mr-2 h-4 w-4"></i>
                            View Payroll
                        </button>
                    </div>
                    <div class="payroll-body">
                        <div class="payroll-summary">
                            <div class="summary-item">
                                <span class="item-label">Latest Payroll</span>
                                <span class="item-value">₱45,465</span>
                            </div>
                            <div class="summary-item">
                                <span class="item-label">Year to Date (YTD)</span>
                                <span class="item-value">₱45,465</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Attendance Logs -->
                <div class="activity-container">
                    <div class="activity-header">
                        <h3 class="activity-title">Attendance Logs</h3>
                    </div>
                    <div class="activity-body">
                        <table class="activity-table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Clock In</th>
                                    <th>Clock Out</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="td-date">Apr 25, 2024</td>
                                    <td>08:52 AM</td>
                                    <td>06:12 PM</td>
                                    <td><span class="badge-emerald">Ontime</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Sidebar Section -->
            <div class="dashboard-column">
                <div class="leave-form-container">
                    <h3 class="leave-form-title">Leave Request</h3>
                    <form action="#" method="POST" class="space-y-6">
                        @csrf
                        <div class="form-group">
                            <label class="item-label">Leave Type</label>
                            <select name="leave_type" class="form-select">
                                <option>Sick Leave</option>
                                <option>Vacation Leave</option>
                                <option>Emergency Leave</option>
                            </select>
                        </div>
                        <div class="form-row-2">
                            <div class="form-group">
                                <label class="item-label">Start Date</label>
                                <input type="date" name="start_date" class="form-input">
                            </div>
                            <div class="form-group">
                                <label class="item-label">End Date</label>
                                <input type="date" name="end_date" class="form-input">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="item-label">Reason</label>
                            <textarea name="reason" rows="4" class="form-textarea" placeholder="Details..."></textarea>
                        </div>
                        <button type="submit" class="btn-primary btn-full">Submit Request</button>
                    </form>
                </div>

                <!-- Announcements -->
                <div class="stat-card announcement-card">
                    <h3 class="activity-title">Announcements</h3>
                    <div class="announcement-item">
                        <p class="item-label">Company News</p>
                        <h4 class="announcement-title">Labor Day Holiday</h4>
                        <p class="announcement-desc">Office will be closed on May 01.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection