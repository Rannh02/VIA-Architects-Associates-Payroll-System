@extends('layouts.master')

@section('title', 'My Requests - VIA Architects Associates')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/manage-employee.css') }}">
    <style>
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

        .badge-pending { background: #fef3c7; color: #92400e; }
        .badge-approved { background: #d1fae5; color: #065f46; }
        .badge-rejected { background: #fee2e2; color: #991b1b; }
        .badge-leave-type { background: #dbeafe; color: #1e40af; }

        /* Dark Mode Overrides */
        .dark-mode .approval-table-container { background: #1e293b; border-color: #334155; }
        .dark-mode .approval-table thead tr { background: #0f172a; border-color: #334155; }
        .dark-mode .approval-table th { color: #94a3b8; }
        .dark-mode .approval-table tbody tr { border-color: #334155; color: #e2e8f0; }
        .dark-mode .approval-table tbody tr:hover { background-color: #334155; }
        
        .dark-mode .badge-pending { background: rgba(245, 158, 11, 0.1); color: #fbbf24; }
        .dark-mode .badge-approved { background: rgba(16, 185, 129, 0.1); color: #34d399; }
        .dark-mode .badge-rejected { background: rgba(239, 68, 68, 0.1); color: #f87171; }
        .dark-mode .badge-leave-type { background: rgba(59, 130, 246, 0.1); color: #60a5fa; }
    </style>
@endsection

@section('content')
    <div class="max-w-[1600px] mx-auto">
        <div class="content-header">
            <div>
                <h2 class="header-title">My Requests</h2>
                <p class="header-subtitle">
                    <span class="subtitle-dot"></span>
                    Track the status of your submitted leave requests
                </p>
            </div>
            <div class="header-actions">
                <a href="{{ route('user.leave_form') }}" class="btn-primary">
                    <i data-lucide="plus" class="h-4 w-4 mr-2"></i>
                    New Request
                </a>
            </div>
        </div>

        <div class="approval-table-container">
            <table class="approval-table">
                <thead>
                    <tr>
                        <th>Date Filed</th>
                        <th>Leave Type</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Reason</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($leaveRequests as $leave)
                        <tr>
                            <td style="color: #64748b;">{{ \Carbon\Carbon::parse($leave->date_filed)->format('M d, Y') }}</td>
                            <td>
                                <span class="leave-badge badge-leave-type">
                                    {{ ucfirst($leave->leave_type) }}
                                </span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($leave->start_date)->format('M d, Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($leave->end_date)->format('M d, Y') }}</td>
                            <td style="max-width: 300px;">
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
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="padding: 3rem; text-align: center; color: #64748b;">
                                <i data-lucide="inbox" class="h-12 w-12 mx-auto mb-3 opacity-20"></i>
                                <p>You haven't submitted any requests yet.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
