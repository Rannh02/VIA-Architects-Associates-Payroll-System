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
                    ['label' => 'Over Time', 'value' => 9, 'icon' => 'clock', 'color' => 'amber', 'badge' => 'Hour'],
                    
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

        <!-- Financial Summary Chart -->
        <div class="chart-card" style="margin-top: 0;">
            <div class="chart-card-header" style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 1rem;">
                <div>
                    <h3 class="chart-card-title">
                        <i data-lucide="trending-up" class="h-5 w-5" style="color: #3b82f6;"></i>
                        Financial Summary — Payroll by Month
                    </h3>
                    <p class="chart-card-subtitle">Monthly payroll expenses for the current year</p>
                </div>
                <div style="display: flex; gap: 1rem;">
                    <div class="summary-item" style="margin: 0; padding: 1rem;">
                        <span class="item-label">Latest Payroll</span>
                        <span class="item-value" style="font-size: 1.25rem;">₱45,465</span>
                    </div>
                    <div class="summary-item" style="margin: 0; padding: 1rem;">
                        <span class="item-label">Year to Date (YTD)</span>
                        <span class="item-value" style="font-size: 1.25rem;">₱545,580</span>
                    </div>
                    <button id="btn-view-payroll" class="btn-view-payroll" style="align-self: center;">
                        <i data-lucide="external-link" class="mr-2 h-4 w-4"></i> View Details
                    </button>
                </div>
            </div>
            <div class="chart-container" style="height: 280px;">
                <canvas id="financialSummaryChart"></canvas>
            </div>
        </div>

        <!-- Wireframe Charts -->
        <div class="charts-grid">
            <!-- Deduction Composition -->
            <div class="chart-card">
                <div class="chart-card-header">
                    <h3 class="chart-card-title">
                        <i data-lucide="package" class="h-5 w-5" style="color: #f59e0b;"></i>
                        Deduction Composition — Per Employee
                    </h3>
                    <p class="chart-card-subtitle">Stacked breakdown of SSS, PhilHealth, Pag-IBIG, Tax & Absences</p>
                </div>
                <div class="chart-container">
                    <canvas id="deductionChart"></canvas>
                </div>
            </div>

            <!-- Attendance Summary -->
            <div class="chart-card">
                <div class="chart-card-header">
                    <h3 class="chart-card-title">
                        <i data-lucide="calendar" class="h-5 w-5" style="color: #6366f1;"></i>
                        Attendance Summary — Per Employee
                    </h3>
                    <p class="chart-card-subtitle">Present, absent & late days for June 2025</p>
                </div>
                <div class="chart-container">
                    <canvas id="attendanceChart"></canvas>
                </div>
            </div>
        </div>

    </div>

    <!-- Payroll Summary Modal -->
    <div id="payroll-modal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header modal-header-flex">
                <h3 class="modal-title">Payroll Summary</h3>
                <div class="modal-actions">
                    <div class="form-group modal-filter-group">
                        <input type="month" name="payroll_month" class="form-input filter-select" value="{{ date('Y-m') }}">
                    </div>
                    <button id="btn-close-modal" class="modal-close">
                        <i data-lucide="x" class="h-5 w-5"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <div class="modal-table-container">
                    <table class="modal-table">
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th>Basic Salary</th>
                                <th>Over Time</th>
                                <th>Absent & Late</th>
                                <th>SSS</th>
                                <th>PhilHealth</th>
                                <th>Pag-Ibig</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Regular Pay</td>
                                <td>₱25,000</td>
                                <td>₱1,500</td>
                                <td>-₱500</td>
                                <td>-₱1,125</td>
                                <td>-₱500</td>
                                <td>-₱100</td>
                                <td>
                                    <button class="btn-icon"><i data-lucide="eye" class="h-4 w-4"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>Allowances</td>
                                <td>₱5,000</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>
                                    <button class="btn-icon"><i data-lucide="eye" class="h-4 w-4"></i></button>
                                </td>
                            </tr>
                            <tr class="table-row-total">
                                <td>Total</td>
                                <td>₱30,000</td>
                                <td>₱1,500</td>
                                <td>-₱500</td>
                                <td>-₱1,125</td>
                                <td>-₱500</td>
                                <td>-₱100</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Modal Logic
            const modal = document.getElementById('payroll-modal');
            const openBtn = document.getElementById('btn-view-payroll');
            const closeBtn = document.getElementById('btn-close-modal');

            if (openBtn) {
                openBtn.addEventListener('click', function () {
                    modal.classList.add('show');
                    lucide.createIcons();
                });
            }

            if (closeBtn) {
                closeBtn.addEventListener('click', function () {
                    modal.classList.remove('show');
                });
            }

            modal.addEventListener('click', function (e) {
                if (e.target === modal) {
                    modal.classList.remove('show');
                }
            });

            // Dark mode variable detection for charts
            const isDark = document.documentElement.classList.contains('dark-mode');
            const textColor = isDark ? '#94a3b8' : '#64748b';
            const gridColor = isDark ? 'rgba(255, 255, 255, 0.05)' : 'rgba(0, 0, 0, 0.05)';

            // Common Chart Options
            const commonOptions = {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { 
                            usePointStyle: true, 
                            boxWidth: 8,
                            color: textColor,
                            font: { family: "'Inter', sans-serif", weight: 600 }
                        }
                    }
                }
            };

            // 1. Financial Summary Line Chart
            new Chart(document.getElementById('financialSummaryChart'), {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Monthly Payroll (₱)',
                        data: [42000, 42500, 43000, 45000, 45000, 45465, 45465, 46000, 46000, 47000, 47000, 50000],
                        borderColor: '#3b82f6',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#3b82f6',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    ...commonOptions,
                    scales: {
                        y: { 
                            beginAtZero: true, 
                            grid: { color: gridColor },
                            ticks: { color: textColor, callback: function(value) { return '₱' + (value/1000) + 'k'; } }
                        },
                        x: { 
                            grid: { display: false },
                            ticks: { color: textColor }
                        }
                    }
                }
            });

            // 2. Deduction Composition (Stacked Bar)
            new Chart(document.getElementById('deductionChart'), {
                type: 'bar',
                data: {
                    labels: ['Maria', 'Juan', 'Ana', 'Carlo', 'Liza'],
                    datasets: [
                        { label: 'SSS', data: [1500, 1500, 1500, 1500, 1500], backgroundColor: '#8b5cf6', borderRadius: {bottomLeft: 4, bottomRight: 4} },
                        { label: 'PhilHealth', data: [1200, 800, 700, 1000, 1100], backgroundColor: '#10b981' },
                        { label: 'Pag-IBIG', data: [300, 200, 200, 200, 200], backgroundColor: '#0ea5e9' },
                        { label: 'Tax', data: [7500, 3000, 1500, 5500, 5300], backgroundColor: '#ef4444' },
                        { label: 'Absences', data: [600, 250, 4600, 600, 2700], backgroundColor: '#f59e0b', borderRadius: {topLeft: 4, topRight: 4} }
                    ]
                },
                options: {
                    ...commonOptions,
                    scales: {
                        x: { 
                            stacked: true, 
                            grid: { display: false },
                            ticks: { color: textColor }
                        },
                        y: { 
                            stacked: true, 
                            grid: { borderDash: [4, 4], color: gridColor }, 
                            ticks: { color: textColor, callback: function(value) { return '₱' + (value/1000) + 'k'; } } 
                        }
                    }
                }
            });

            // 3. Attendance Summary (Grouped Bar)
            new Chart(document.getElementById('attendanceChart'), {
                type: 'bar',
                data: {
                    labels: ['Maria', 'Juan', 'Ana', 'Carlo', 'Liza'],
                    datasets: [
                        { label: 'Present Days', data: [21, 22, 19, 22, 21], backgroundColor: '#10b981', barPercentage: 0.6, categoryPercentage: 0.8, borderRadius: 2 },
                        { label: 'Absent Days', data: [0, 0, 3, 0, 1], backgroundColor: '#ef4444', barPercentage: 0.6, categoryPercentage: 0.8, borderRadius: 2 },
                        { label: 'Late Days', data: [4, 5, 4, 5, 3], backgroundColor: '#f59e0b', barPercentage: 0.6, categoryPercentage: 0.8, borderRadius: 2 },
                        { label: 'OT Hours', data: [5, 6, 7, 3, 3], backgroundColor: '#3b82f6', barPercentage: 0.6, categoryPercentage: 0.8, borderRadius: 2 }
                    ]
                },
                options: {
                    ...commonOptions,
                    scales: {
                        x: { 
                            grid: { display: false },
                            ticks: { color: textColor }
                        },
                        y: { 
                            grid: { borderDash: [4, 4], color: gridColor }, 
                            min: 0, 
                            max: 25, 
                            ticks: { stepSize: 6, color: textColor } 
                        }
                    }
                }
            });
        });
    </script>
@endsection