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
                        <button id="btn-view-payroll" class="btn-view-payroll">
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
                            <!-- Example Static Rows based on wireframe -->
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('payroll-modal');
            const openBtn = document.getElementById('btn-view-payroll');
            const closeBtn = document.getElementById('btn-close-modal');

            // Open modal
            if (openBtn) {
                openBtn.addEventListener('click', function () {
                    modal.classList.add('show');
                    // Re-initialize lucide icons for modal content
                    lucide.createIcons();
                });
            }

            // Close modal
            if (closeBtn) {
                closeBtn.addEventListener('click', function () {
                    modal.classList.remove('show');
                });
            }

            // Close modal on click outside
            modal.addEventListener('click', function (e) {
                if (e.target === modal) {
                    modal.classList.remove('show');
                }
            });
        });
    </script>
@endsection