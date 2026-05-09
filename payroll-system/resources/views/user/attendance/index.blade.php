@extends('layouts.master')

@section('title', 'Attendance Summary Report - VIA Architects Associates')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/user/style.css') }}">
@endsection

@section('content')
    <div class="main-content-inner">
        <div class="content-header">
            <div>
                <h2 class="header-title">Attendance Summary Report</h2>
            </div>
        </div>

        <div class="report-card">
            <!-- Date Filters -->
            <div class="report-section">
                <div class="date-filters">
                    <div class="filter-group">
                        <label class="filter-label" for="from_date">From:</label>
                        <input type="date" id="from_date" name="from_date" class="form-input" value="{{ date('Y-m-d') }}">
                    </div>
                    <div class="filter-group">
                        <label class="filter-label" for="to_date">To:</label>
                        <input type="date" id="to_date" name="to_date" class="form-input" value="{{ date('Y-m-d') }}">
                    </div>
                </div>
            </div>

            <div class="report-divider"></div>

            <!-- Options Section -->
            <div class="report-section">
                <div class="options-grid">
                    <div class="options-row">
                        <label class="checkbox-item">
                            <input type="checkbox" name="absences" checked>
                            <span class="checkbox-label">Absences</span>
                        </label>
                        <label class="checkbox-item">
                            <input type="checkbox" name="tardiness" checked>
                            <span class="checkbox-label">Tardiness</span>
                        </label>
                        <label class="checkbox-item">
                            <input type="checkbox" name="undertime" checked>
                            <span class="checkbox-label">Undertime</span>
                        </label>
                        <label class="checkbox-item">
                            <input type="checkbox" name="unpaid_leave" checked>
                            <span class="checkbox-label">Unpaid Leave</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="report-divider"></div>

            <!-- Actions -->
            <div class="report-section">
                <div class="report-actions">
                    <button type="button" class="btn-generate">Generate</button>
                    <button type="button" class="btn-download">Download Complete Report</button>
                </div>
            </div>

            <div class="report-divider"></div>

            <!-- Results Table -->
            <div class="results-table-container">
                <table class="results-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Day Present</th>
                            <th>Days Absence</th>
                            <th>Late</th>
                            <th>UMT</th>
                            <th>Total late / UTM</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 2rem; color: #64748b;">
                                No attendance records found for the selected period.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Lower Grid Section -->
        <!-- <div class="dashboard-grid dashboard-grid-margin">
             Attendance Logs 
            <div class="dashboard-column" style="grid-column: span 3;">
                <div class="activity-container">
                    <div class="activity-header">
                        <h3 class="activity-title recent-logs-title">
                            Recent Logs</h3>
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
                                    <td><span class="badge-emerald">Ontime</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> -->

            <!-- Leave Form
            <div class="dashboard-column" style="grid-column: span 2;">
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
            </div>
        </div>
    </div> -->

    <!-- Attendance Detail Modal -->
    <!-- <div id="attendanceModal" class="modal-overlay">
        <div class="modal-content">
            <button id="closeModal" class="modal-close">
                <i data-lucide="x" class="h-5 w-5"></i>
            </button>

            <div class="modal-header">
                <h3 class="report-header-title mb-6">Detailed Attendance Log</h3>
                <div class="modal-info-grid">
                    <div class="info-tag">
                        <span class="info-tag-label">Fullname</span>
                        <span id="modalName">{{ Auth::user()->name }}</span>
                    </div>
                    <div class="info-tag">
                        <span class="info-tag-label">Selected Date</span>
                        <span id="modalDate">{{ date('F d, Y') }}</span>
                    </div>
                </div>
            </div> -->

            <!-- <div class="modal-table-container">
                <table class="modal-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Day</th>
                            <th>Shift</th>
                            <th>Late Minutes</th>
                            <th>Undertime Minutes</th>
                            <th>Total Hours</th>
                        </tr>
                    </thead>
                    <tbody id="modalTableBody"> -->
                        <!-- Placeholder data -->
                        <!-- <tr>
                            <td>{{ date('Y-m-d') }}</td>
                            <td>{{ date('l') }}</td>
                            <td>Morning Shift</td>
                            <td>0 mins</td>
                            <td>0 mins</td>
                            <td>8 hrs</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div> -->

    @section('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const modal = document.getElementById('attendanceModal');
                const closeModal = document.getElementById('closeModal');
                const tableRows = document.querySelectorAll('.results-table tbody tr');

                if (tableRows.length > 0 && modal) {
                    tableRows.forEach(row => {
                        row.addEventListener('click', () => {
                            // In a real app, you'd fetch data here based on the row clicked
                            modal.classList.add('show');
                            document.body.style.overflow = 'hidden'; // Prevent scroll
                        });
                    });
                }

                if (closeModal) {
                    closeModal.addEventListener('click', () => {
                        modal.classList.remove('show');
                        document.body.style.overflow = '';
                    });
                }

                // Close on backdrop click
                modal.addEventListener('click', (e) => {
                    if (e.target === modal) {
                        modal.classList.remove('show');
                        document.body.style.overflow = '';
                    }
                });
            });
        </script>
    @endsection
@endsection