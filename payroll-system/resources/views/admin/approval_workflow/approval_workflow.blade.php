@extends('layouts.master')

@section('title', 'Approval Workflow - VIA Architects Associates')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/manage-employee.css') }}">
    <style>
        /* Modal Styles */
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
            background: #fee2e2;
            color: #dc2626;
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
        .btn-modal-danger {
            background: #dc2626;
            color: white;
        }
        .btn-modal-danger:hover {
            background: #b91c1c;
        }
        
        .dark-mode .modal-overlay { background: rgba(0, 0, 0, 0.6); }
        .dark-mode .modal-content { background: #1e293b; border-color: #334155; }
        .dark-mode .modal-title { color: #f8fafc; }
        .dark-mode .modal-description { color: #94a3b8; }
        .dark-mode .modal-footer { background: #0f172a; border-color: #334155; }
        .dark-mode .btn-modal-secondary { background: #1e293b; border-color: #475569; color: #cbd5e1; }
        .dark-mode .btn-modal-secondary:hover { background: #334155; border-color: #64748b; }
        
        .approval-table-container {

            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            background: white;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            margin-top: 1.5rem;
        }

        .approval-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .approval-table thead tr {
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
        }

        .approval-table th {
            padding: 1rem 1.5rem;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #64748b;
        }

        .approval-table tbody tr {
            border-bottom: 1px solid #f1f5f9;
            transition: all 0.2s;
        }

        .approval-table tbody tr:hover {
            background-color: #f8fafc;
        }

        .approval-table td {
            padding: 1rem 1.5rem;
            vertical-align: middle;
            font-size: 0.875rem;
        }

        .leave-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.625rem;
            border-radius: 0.5rem;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-approved {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-rejected {
            background: #fee2e2;
            color: #991b1b;
        }

        .badge-leave-type {
            background: #dbeafe;
            color: #1e40af;
        }

        /* Dark Mode Overrides */
        .dark-mode .approval-table-container {
            background: #1e293b;
            border-color: #334155;
        }

        .dark-mode .approval-table thead tr {
            background: #0f172a;
            border-color: #334155;
        }

        .dark-mode .approval-table th {
            color: #94a3b8;
        }

        .dark-mode .approval-table tbody tr {
            border-color: #334155;
            color: #e2e8f0;
        }

        .dark-mode .approval-table tbody tr:hover {
            background-color: #334155;
        }

        .dark-mode .badge-pending {
            background: rgba(245, 158, 11, 0.1);
            color: #fbbf24;
        }

        .dark-mode .badge-approved {
            background: rgba(16, 185, 129, 0.1);
            color: #34d399;
        }

        .dark-mode .badge-rejected {
            background: rgba(239, 68, 68, 0.1);
            color: #f87171;
        }

        .dark-mode .badge-leave-type {
            background: rgba(59, 130, 246, 0.1);
            color: #60a5fa;
        }
        
        .employee-action-link {
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <div class="max-w-[1600px] mx-auto">
        <div class="content-header">
            <div>
                <h2 class="header-title">Approval Workflow</h2>
                <p class="header-subtitle">
                    <span class="subtitle-dot"></span>
                    Review and manage employee leave requests
                </p>
            </div>
        </div>

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="alert alert-success" style="margin-bottom: 1.5rem;">
                <i data-lucide="check-circle"></i> {{ session('success') }}
            </div>
        @endif

        {{-- Leave Requests Table --}}
        <div class="approval-table-container">
            <table class="approval-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Employee</th>
                        <th>Department</th>
                        <th>Leave Type</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Date Filed</th>
                        <th>Reason</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($leaveRequests as $index => $leave)
                        <tr>
                            <td style="color: #64748b;">{{ $index + 1 }}</td>
                            <td>
                                <div class="employee-name-cell">
                                    <img src="{{ $leave->employee->photo_url }}" alt="" class="employee-avatar" style="object-fit: cover;">
                                    <div>
                                        <div style="font-weight: 600; color: inherit;">
                                            {{ $leave->employee->first_name ?? '—' }} {{ $leave->employee->last_name ?? '' }}
                                        </div>
                                        <div style="font-size: 0.75rem; color: #64748b;">
                                            {{ $leave->employee->position->position_name ?? 'N/A' }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $leave->employee->department->department_name ?? '—' }}</td>
                            <td>
                                <span class="leave-badge badge-leave-type">
                                    {{ ucfirst($leave->leave_type) }}
                                </span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($leave->start_date)->format('M d, Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($leave->end_date)->format('M d, Y') }}</td>
                            <td style="color: #64748b;">{{ \Carbon\Carbon::parse($leave->date_filed)->format('M d, Y') }}</td>
                            <td style="max-width: 180px;">
                                <span title="{{ $leave->reason }}"
                                    style="display: block; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    {{ $leave->reason ?: '—' }}
                                </span>
                            </td>
                            <td>
                                @if($leave->status === 'pending')
                                    <span class="leave-badge badge-pending">Pending</span>
                                @elseif($leave->status === 'approved')
                                    <span class="leave-badge badge-approved">Approved</span>
                                @else
                                    <span class="leave-badge badge-rejected">Rejected</span>
                                @endif
                            </td>
                            <td>
                                <div class="employee-action-group">
                                    @if($leave->status === 'pending')
                                        <button type="button" class="employee-action-link action-view"
                                            style="background: none; border: 1px solid #e2e8f0; color: #10b981;"
                                            onclick="openApproveModal('{{ route('approval_workflow.status', $leave->leave_request_id) }}', '{{ $leave->employee->first_name }} {{ $leave->employee->last_name }}')">
                                            Approve
                                        </button>
                                        
                                        <button type="button" class="employee-action-link action-archive"
                                            style="background: none; border: 1px solid #e2e8f0;"
                                            onclick="openRejectModal('{{ route('approval_workflow.status', $leave->leave_request_id) }}', '{{ $leave->employee->first_name }} {{ $leave->employee->last_name }}')">
                                            Reject
                                        </button>
                                    @else
                                        <span style="font-size: 0.75rem; color: #64748b; font-style: italic;">Processed</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" style="padding: 3rem; text-align: center; color: #64748b;">
                                No leave requests found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Approve Confirmation Modal -->
    <div id="approve-modal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-inner">
                <div class="modal-top">
                    <div class="modal-icon-container" style="background: rgba(16, 185, 129, 0.1); color: #10b981; border-color: rgba(16, 185, 129, 0.2);">
                        <i data-lucide="check-circle" class="h-6 w-6"></i>
                    </div>
                    <div class="modal-info">
                        <h3 class="modal-title">Approve Leave Request</h3>
                        <p class="modal-description">
                            Are you sure you want to approve the leave request for <strong id="approve-employee-name" style="color: inherit; font-weight: 700;"></strong>? 
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-modal btn-modal-secondary" onclick="closeApproveModal()">Cancel</button>
                <form id="approve-form" method="POST" style="margin: 0;">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="approved">
                    <button type="submit" class="btn-modal" style="background: #10b981; border-color: #10b981; color: white;">Approve Request</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Reject Confirmation Modal -->
    <div id="reject-modal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-inner">
                <div class="modal-top">
                    <div class="modal-icon-container">
                        <i data-lucide="alert-triangle" class="h-6 w-6"></i>
                    </div>
                    <div class="modal-info">
                        <h3 class="modal-title">Reject Leave Request</h3>
                        <p class="modal-description">
                            Are you sure you want to reject the leave request for <strong id="reject-employee-name" style="color: inherit; font-weight: 700;"></strong>?
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-modal btn-modal-secondary" onclick="closeRejectModal()">Cancel</button>
                <form id="reject-form" method="POST" style="margin: 0;">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="rejected">
                    <button type="submit" class="btn-modal btn-modal-danger">Reject Request</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function openApproveModal(actionUrl, employeeName) {
            document.getElementById('approve-form').action = actionUrl;
            document.getElementById('approve-employee-name').textContent = employeeName;
            document.getElementById('approve-modal').classList.add('show');
        }

        function closeApproveModal() {
            document.getElementById('approve-modal').classList.remove('show');
        }

        function openRejectModal(actionUrl, employeeName) {
            document.getElementById('reject-form').action = actionUrl;
            document.getElementById('reject-employee-name').textContent = employeeName;
            document.getElementById('reject-modal').classList.add('show');
        }

        function closeRejectModal() {
            document.getElementById('reject-modal').classList.remove('show');
        }
        
        // Close modals when clicking outside
        window.addEventListener('click', function(event) {
            const approveModal = document.getElementById('approve-modal');
            const rejectModal = document.getElementById('reject-modal');
            if (event.target === approveModal) closeApproveModal();
            if (event.target === rejectModal) closeRejectModal();
        });
    </script>
@endsection