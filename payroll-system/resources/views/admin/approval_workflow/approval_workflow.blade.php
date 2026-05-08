@extends('layouts.master')

@section('title', 'Approval Workflow - VIA Architects Associates')

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
        <div style="background:#d1fae5;color:#065f46;border:1px solid #6ee7b7;padding:12px 16px;border-radius:8px;margin-bottom:16px;display:flex;align-items:center;gap:8px;">
            <i data-lucide="check-circle" class="h-4 w-4"></i> {{ session('success') }}
        </div>
    @endif

    {{-- Leave Requests Table --}}
    <div class="overflow-x-auto rounded-xl shadow-sm">
        <table style="width:100%;border-collapse:collapse;background:var(--bg-surface,#fff);border-radius:12px;overflow:hidden;">
            <thead>
                <tr style="background:var(--bg-muted,#f3f4f6);">
                    <th style="padding:12px 16px;text-align:left;font-size:0.75rem;font-weight:600;text-transform:uppercase;color:var(--text-muted,#6b7280);">#</th>
                    <th style="padding:12px 16px;text-align:left;font-size:0.75rem;font-weight:600;text-transform:uppercase;color:var(--text-muted,#6b7280);">Employee</th>
                    <th style="padding:12px 16px;text-align:left;font-size:0.75rem;font-weight:600;text-transform:uppercase;color:var(--text-muted,#6b7280);">Department</th>
                    <th style="padding:12px 16px;text-align:left;font-size:0.75rem;font-weight:600;text-transform:uppercase;color:var(--text-muted,#6b7280);">Leave Type</th>
                    <th style="padding:12px 16px;text-align:left;font-size:0.75rem;font-weight:600;text-transform:uppercase;color:var(--text-muted,#6b7280);">Start Date</th>
                    <th style="padding:12px 16px;text-align:left;font-size:0.75rem;font-weight:600;text-transform:uppercase;color:var(--text-muted,#6b7280);">End Date</th>
                    <th style="padding:12px 16px;text-align:left;font-size:0.75rem;font-weight:600;text-transform:uppercase;color:var(--text-muted,#6b7280);">Date Filed</th>
                    <th style="padding:12px 16px;text-align:left;font-size:0.75rem;font-weight:600;text-transform:uppercase;color:var(--text-muted,#6b7280);">Reason</th>
                    <th style="padding:12px 16px;text-align:left;font-size:0.75rem;font-weight:600;text-transform:uppercase;color:var(--text-muted,#6b7280);">Status</th>
                    <th style="padding:12px 16px;text-align:left;font-size:0.75rem;font-weight:600;text-transform:uppercase;color:var(--text-muted,#6b7280);">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($leaveRequests as $index => $leave)
                <tr style="border-top:1px solid var(--glass-border,#e5e7eb);">
                    <td style="padding:14px 16px;color:var(--text-muted,#6b7280);font-size:0.875rem;">{{ $index + 1 }}</td>
                    <td style="padding:14px 16px;">
                        <div style="font-weight:600;color:var(--text-main,#111827);font-size:0.875rem;">
                            {{ $leave->employee->first_name ?? '—' }} {{ $leave->employee->last_name ?? '' }}
                        </div>
                        <div style="font-size:0.75rem;color:var(--text-muted,#6b7280);">
                            {{ $leave->employee->position->position_name ?? 'N/A' }}
                        </div>
                    </td>
                    <td style="padding:14px 16px;font-size:0.875rem;color:var(--text-main,#374151);">
                        {{ $leave->employee->department->department_name ?? '—' }}
                    </td>
                    <td style="padding:14px 16px;">
                        <span style="display:inline-flex;align-items:center;padding:3px 10px;border-radius:999px;font-size:0.75rem;font-weight:500;background:#dbeafe;color:#1d4ed8;">
                            {{ ucfirst($leave->leave_type) }}
                        </span>
                    </td>
                    <td style="padding:14px 16px;font-size:0.875rem;color:var(--text-main,#374151);">
                        {{ \Carbon\Carbon::parse($leave->start_date)->format('M d, Y') }}
                    </td>
                    <td style="padding:14px 16px;font-size:0.875rem;color:var(--text-main,#374151);">
                        {{ \Carbon\Carbon::parse($leave->end_date)->format('M d, Y') }}
                    </td>
                    <td style="padding:14px 16px;font-size:0.875rem;color:var(--text-muted,#6b7280);">
                        {{ \Carbon\Carbon::parse($leave->date_filed)->format('M d, Y') }}
                    </td>
                    <td style="padding:14px 16px;font-size:0.875rem;color:var(--text-main,#374151);max-width:180px;">
                        <span title="{{ $leave->reason }}" style="display:block;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                            {{ $leave->reason ?: '—' }}
                        </span>
                    </td>
                    <td style="padding:14px 16px;">
                        @if($leave->status === 'pending')
                            <span style="display:inline-flex;align-items:center;padding:3px 10px;border-radius:999px;font-size:0.75rem;font-weight:600;background:#fef3c7;color:#92400e;">
                                ● Pending
                            </span>
                        @elseif($leave->status === 'approved')
                            <span style="display:inline-flex;align-items:center;padding:3px 10px;border-radius:999px;font-size:0.75rem;font-weight:600;background:#d1fae5;color:#065f46;">
                                ✓ Approved
                            </span>
                        @else
                            <span style="display:inline-flex;align-items:center;padding:3px 10px;border-radius:999px;font-size:0.75rem;font-weight:600;background:#fee2e2;color:#991b1b;">
                                ✕ Rejected
                            </span>
                        @endif
                    </td>
                    <td style="padding:14px 16px;">
                        @if($leave->status === 'pending')
                            <div style="display:flex;gap:8px;">
                                {{-- Approve --}}
                                <form action="{{ route('approval_workflow.status', $leave->leave_request_id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit"
                                        onclick="return confirm('Approve this leave request?')"
                                        style="padding:5px 14px;background:#10b981;color:#fff;border:none;border-radius:6px;font-size:0.8rem;font-weight:600;cursor:pointer;">
                                        Approve
                                    </button>
                                </form>
                                {{-- Reject --}}
                                <form action="{{ route('approval_workflow.status', $leave->leave_request_id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit"
                                        onclick="return confirm('Reject this leave request?')"
                                        style="padding:5px 14px;background:#ef4444;color:#fff;border:none;border-radius:6px;font-size:0.8rem;font-weight:600;cursor:pointer;">
                                        Reject
                                    </button>
                                </form>
                            </div>
                        @else
                            <span style="font-size:0.8rem;color:var(--text-muted,#9ca3af);">No action</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" style="padding:40px 16px;text-align:center;color:var(--text-muted,#6b7280);font-size:0.9rem;">
                        No leave requests found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection