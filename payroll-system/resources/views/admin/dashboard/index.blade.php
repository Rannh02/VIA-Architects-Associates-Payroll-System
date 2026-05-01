@extends('layouts.master')

@section('title', 'Dashboard - VIA Architects Associates')

@section('content')
    <div class="max-w-[1600px] mx-auto">
        <div class="content-header">
            <div>
                <h2 class="header-title">Dashboard Overview</h2>
                <p class="header-subtitle">
                    <span class="subtitle-dot"></span>
                    Welcome back, Administrator! Here's your current payroll summary.
                </p>
            </div>
            <div class="header-actions">
                <button class="btn-secondary">
                    <i data-lucide="calendar" class="h-4 w-4 text-blue-500"></i>
                    Last 30 Days
                </button>
                <button class="btn-primary">
                    <i data-lucide="plus" class="h-4 w-4"></i>
                    New Report
                </button>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon stat-icon-teal">
                        <i data-lucide="users" class="h-6 w-6"></i>
                    </div>
                    <span class="stat-badge badge-emerald">+12.5%</span>
                </div>
                <h3 class="stat-label">Total Employees</h3>
                <p class="stat-value">156</p>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon stat-icon-indigo">
                        <i data-lucide="banknote" class="h-6 w-6"></i>
                    </div>
                    <span class="stat-badge badge-teal">Active</span>
                </div>
                <h3 class="stat-label">Payroll Processed</h3>
                <p class="stat-value">98.2%</p>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon stat-icon-amber">
                        <i data-lucide="clock" class="h-6 w-6"></i>
                    </div>
                    <span class="stat-badge badge-amber">Pending</span>
                </div>
                <h3 class="stat-label">Pending Approvals</h3>
                <p class="stat-value">24</p>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon stat-icon-rose">
                        <i data-lucide="file-text" class="h-6 w-6"></i>
                    </div>
                    <span class="stat-badge badge-muted">Weekly</span>
                </div>
                <h3 class="stat-label">Reports Generated</h3>
                <p class="stat-value">42</p>
            </div>
        </div>

        <!-- Recent Activity Section -->
        <div class="activity-container">
            <div class="activity-header">
                <h3 class="activity-title">Recent System Activity</h3>
                <button class="activity-link">
                    View History
                    <i data-lucide="arrow-right" class="h-4 w-4 group-hover:translate-x-1 transition-transform"></i>
                </button>
            </div>
            <div class="activity-empty-state">
                <div class="activity-empty-icon">
                    <i data-lucide="layout" class="h-12 w-12 text-slate-600"></i>
                </div>
                <h4 class="activity-empty-title">No activity found</h4>
                <p class="activity-empty-desc">Detailed logs and payroll events will be displayed here as the system
                    processes employee data.</p>
                <button class="activity-refresh-btn">
                    Refresh Data Feed
                </button>
            </div>
        </div>
    </div>
@endsection