@extends('layouts.master')

@section('title', 'Reports & Analytics - VIA Architects Associates')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/reports.css') }}">
@endsection

@section('content')
    <div class="max-w-[1600px] mx-auto">
        
        <!-- Header -->
        <div class="content-header">
            <div>
                <h2 class="header-title">Reports & Analytics</h2>
                <p class="header-subtitle">
                    <span class="subtitle-dot"></span>
                    Generate and download comprehensive system reports.
                </p>
            </div>
            
            <div class="header-actions">
                <button class="btn-primary">
                    <i data-lucide="printer" class="mr-2 h-4 w-4"></i>
                    Print Summary
                </button>
            </div>
        </div>

        <div class="reports-container">
            
            <!-- Global Date Filter -->
            <div class="filters-bar">
                <div class="filter-group-wrapper">
                    <div class="filter-group">
                        <label for="date_from" class="filter-label">From:</label>
                        <input type="date" id="date_from" class="filter-input" value="{{ date('Y-m-01') }}">
                    </div>
                    <div class="filter-group">
                        <label for="date_to" class="filter-label">To:</label>
                        <input type="date" id="date_to" class="filter-input" value="{{ date('Y-m-t') }}">
                    </div>
                </div>
                
                <button class="btn-primary">
                    <i data-lucide="refresh-cw" class="mr-2 h-4 w-4"></i>
                    Apply Filter
                </button>
            </div>

            <!-- Quick Stats -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-label">Total Payroll Cost</span>
                        <div class="stat-icon stat-icon-indigo">
                            <i data-lucide="banknote" class="h-5 w-5"></i>
                        </div>
                    </div>
                    <div class="stat-value">₱ 1,245,000</div>
                    <div class="stat-badge badge-emerald mt-2 inline-block">
                        <i data-lucide="trending-up" class="inline h-3 w-3 mr-1"></i>
                        2.4% vs last month
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-label">Taxes Withheld</span>
                        <div class="stat-icon stat-icon-amber">
                            <i data-lucide="landmark" class="h-5 w-5"></i>
                        </div>
                    </div>
                    <div class="stat-value">₱ 185,200</div>
                    <div class="stat-badge badge-muted mt-2 inline-block">
                        <i data-lucide="minus" class="inline h-3 w-3 mr-1"></i>
                        No change
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-label">Total Overtime (Hrs)</span>
                        <div class="stat-icon stat-icon-rose">
                            <i data-lucide="clock" class="h-5 w-5"></i>
                        </div>
                    </div>
                    <div class="stat-value">342</div>
                    <div class="stat-badge badge-emerald mt-2 inline-block">
                        <i data-lucide="trending-down" class="inline h-3 w-3 mr-1"></i>
                        12% decrease
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-label">Pending Leaves</span>
                        <div class="stat-icon stat-icon-teal">
                            <i data-lucide="calendar-clock" class="h-5 w-5"></i>
                        </div>
                    </div>
                    <div class="stat-value">14</div>
                    <div class="stat-badge badge-amber mt-2 inline-block">
                        <i data-lucide="alert-circle" class="inline h-3 w-3 mr-1"></i>
                        Requires attention
                    </div>
                </div>
            </div>

            <!-- Report Categories -->
            <div>
                <h3 class="report-category-title">
                    <i data-lucide="file-text" class="h-5 w-5 text-primary"></i>
                    Available Reports
                </h3>
                <div class="reports-grid">
                    
                    <!-- Payroll Reports -->
                    <div class="report-card">
                        <div class="report-header">
                            <div class="report-icon-wrapper">
                                <i data-lucide="banknote" class="h-6 w-6"></i>
                            </div>
                            <div class="report-info">
                                <h4 class="report-title">Payroll Reports</h4>
                                <p class="report-desc">Access to detailed payroll reports, including costs, deductions, tax calculations, and employee pay history.</p>
                            </div>
                        </div>
                        <div class="report-actions">
                            <button class="btn-report btn-generate">
                                <i data-lucide="eye" class="h-4 w-4"></i> View
                            </button>
                            <button class="btn-report btn-download">
                                <i data-lucide="download" class="h-4 w-4"></i> Export
                            </button>
                        </div>
                    </div>

                    <!-- Tax Reports -->
                    <div class="report-card">
                        <div class="report-header">
                            <div class="report-icon-wrapper">
                                <i data-lucide="landmark" class="h-6 w-6"></i>
                            </div>
                            <div class="report-info">
                                <h4 class="report-title">Tax Reports</h4>
                                <p class="report-desc">Section for reviewing tax filings, deductions, and reports related to tax compliance.</p>
                            </div>
                        </div>
                        <div class="report-actions">
                            <button class="btn-report btn-generate">
                                <i data-lucide="eye" class="h-4 w-4"></i> View
                            </button>
                            <button class="btn-report btn-download">
                                <i data-lucide="download" class="h-4 w-4"></i> Export
                            </button>
                        </div>
                    </div>
                    
                    <!-- Departmental Reports -->
                    <div class="report-card">
                        <div class="report-header">
                            <div class="report-icon-wrapper">
                                <i data-lucide="users" class="h-6 w-6"></i>
                            </div>
                            <div class="report-info">
                                <h4 class="report-title">Departmental Reports</h4>
                                <p class="report-desc">Payroll breakdown by department, team, or project.</p>
                            </div>
                        </div>
                        <div class="report-actions">
                            <button class="btn-report btn-generate">
                                <i data-lucide="eye" class="h-4 w-4"></i> View
                            </button>
                            <button class="btn-report btn-download">
                                <i data-lucide="download" class="h-4 w-4"></i> Export
                            </button>
                        </div>
                    </div>

                    <!-- Custom Reports -->
                    <div class="report-card">
                        <div class="report-header">
                            <div class="report-icon-wrapper">
                                <i data-lucide="sliders-horizontal" class="h-6 w-6"></i>
                            </div>
                            <div class="report-info">
                                <h4 class="report-title">Custom Reports</h4>
                                <p class="report-desc">Quick access to generate custom reports based on specific criteria (e.g., salary reports, overtime summaries).</p>
                            </div>
                        </div>
                        <div class="report-actions">
                            <button class="btn-report btn-generate">
                                <i data-lucide="settings" class="h-4 w-4"></i> Configure
                            </button>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
