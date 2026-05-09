@extends('layouts.master')

@section('title', 'Payroll Run - VIA Architects Associates')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/manage-employee.css') }}">
    <style>
        .payroll-period-badge {
            display: inline-flex; align-items: center; gap: .4rem;
            background: #eff6ff; color: #1d4ed8;
            border: 1px solid #bfdbfe;
            border-radius: 9999px; padding: 3px 12px; font-size: .78rem; font-weight: 600;
        }
        .payroll-summary-bar {
            display: flex; gap: 1rem; flex-wrap: wrap; margin-bottom: 1.25rem;
        }
        .summary-card {
            flex: 1; min-width: 140px;
            background: #fff; border: 1px solid #e2e8f0; border-radius: .75rem;
            padding: .85rem 1rem;
        }
        .summary-card .sc-label { font-size: .7rem; color: #64748b; text-transform: uppercase; letter-spacing: .04em; font-weight: 600; }
        .summary-card .sc-value { font-size: 1.15rem; font-weight: 700; margin-top: .15rem; }
        .sc-value.green { color: #059669; }
        .sc-value.red   { color: #dc2626; }
        .sc-value.blue  { color: #1d4ed8; }
        .empty-payroll { text-align: center; padding: 2.5rem; color: #94a3b8; font-size: .9rem; }

        /* Dark-mode overrides */
        .dark-mode .summary-card { background: #1e293b; border-color: #334155; }
        .dark-mode .summary-card .sc-label { color: #94a3b8; }
    </style>
@endsection

@section('content')
<div class="max-w-full mx-auto px-6">

    {{-- ── Header ── --}}
    <div class="content-header" style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:1rem;">
        <div>
            <h2 class="header-title">Payroll Run</h2>
            <p class="header-subtitle">
                <span class="subtitle-dot"></span>
                Active Employees &mdash; All Departments
            </p>
        </div>
        {{-- Period filter form --}}
        <form method="GET" action="{{ route('payroll.index') }}"
              style="display:flex; gap:.6rem; align-items:center; flex-wrap:wrap;">
            <label style="font-size:.8rem; font-weight:600; color:#64748b;">Period:</label>
            <input type="date" name="from" value="{{ request('from', now()->startOfMonth()->toDateString()) }}"
                   class="form-input" style="padding:.35rem .6rem; font-size:.82rem; width:140px;">
            <span style="font-size:.8rem; color:#94a3b8;">to</span>
            <input type="date" name="to" value="{{ request('to', now()->endOfMonth()->toDateString()) }}"
                   class="form-input" style="padding:.35rem .6rem; font-size:.82rem; width:140px;">
            <button type="submit" class="btn-primary" style="padding:.38rem .9rem; font-size:.82rem;">
                <i data-lucide="refresh-cw" class="h-4 w-4"></i> Load
            </button>
        </form>
    </div>

    {{-- ── Flash Messages ── --}}
    @if(session('success'))
        <div class="alert alert-success" style="margin-bottom:1rem;">
            <i data-lucide="check-circle"></i> {{ session('success') }}
        </div>
    @endif

    {{-- ── Summary Cards ── --}}
    @php
        $totalGross     = $payrolls->sum('gross_pay');
        $totalDeductions= $payrolls->sum('total_deductions');
        $totalNet       = $payrolls->sum('net_pay');
        $totalEmployees = $employees->count();
    @endphp

    <div class="payroll-summary-bar">
        <div class="summary-card">
            <div class="sc-label">Employees</div>
            <div class="sc-value blue">{{ $totalEmployees }}</div>
        </div>
        <div class="summary-card">
            <div class="sc-label">Total Gross Pay</div>
            <div class="sc-value blue">₱{{ number_format($totalGross, 2) }}</div>
        </div>
        <div class="summary-card">
            <div class="sc-label">Total Deductions</div>
            <div class="sc-value red">-₱{{ number_format($totalDeductions, 2) }}</div>
        </div>
        <div class="summary-card">
            <div class="sc-label">Total Net Pay</div>
            <div class="sc-value green">₱{{ number_format($totalNet, 2) }}</div>
        </div>
        <div class="summary-card">
            <div class="sc-label">Payroll Records</div>
            <div class="sc-value blue">{{ $payrolls->count() }}</div>
        </div>
    </div>

    {{-- ── Search & Department Filter ── --}}
    <div class="employee-search-container">
        <div class="employee-search-input-wrapper">
            <input type="text" id="payrollSearch" placeholder="Search employees..."
                   class="employee-search-input" oninput="filterTable()" />
        </div>
        <div class="employee-department-select">
            <select id="deptFilter" onchange="filterTable()">
                <option value="">All Departments</option>
                @foreach($employees->pluck('department.department_name')->filter()->unique()->sort() as $dept)
                    <option value="{{ $dept }}">{{ $dept }}</option>
                @endforeach
            </select>
        </div>
    </div>

    {{-- ── Payroll Records Table ── --}}
    @if($payrolls->count())
    <div class="employee-table-container">
        <table class="employee-table" id="payrollTable" style="font-size: 0.75rem;">
            <thead>
                <tr>
                    <th>Employee</th>
                    <th>Department</th>
                    <th>Period</th>
                    <th>Basic Salary</th>
                    <th>OT Pay</th>
                    <th>Gross Pay</th>
                    <th>SSS</th>
                    <th>PhilHealth</th>
                    <th>Pag-IBIG</th>
                    <th>Tax</th>
                    <th>Total DED</th>
                    <th>Net Pay</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payrolls as $payroll)
                @php
                    $emp   = $payroll->employee;
                    $name  = $emp ? trim($emp->first_name . ' ' . $emp->last_name) : 'Unknown';
                    $dept  = $emp?->department?->department_name ?? '—';
                    $init  = strtoupper(substr($name, 0, 1));
                    $period= $payroll->payroll_period_start
                           ? date('M d', strtotime($payroll->payroll_period_start)) . ' – ' . date('M d, Y', strtotime($payroll->payroll_period_end))
                           : '—';
                @endphp
                <tr class="payroll-row" data-name="{{ strtolower($name) }}" data-dept="{{ $dept }}">
                    <td class="employee-id">
                        <div class="employee-name-cell">
                            <span class="employee-avatar">{{ $init }}</span>
                            <div>
                                <p class="employee-name">{{ $name }}</p>
                                @if($emp)
                                    <p style="font-size:.68rem; color:#94a3b8;">{{ $emp->position?->position_name ?? '' }}</p>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td>{{ $dept }}</td>
                    <td><span class="payroll-period-badge">{{ $period }}</span></td>
                    <td style="color:#0f172a;">₱{{ number_format($payroll->basic_salary, 2) }}</td>
                    <td style="color:#0f172a;">₱{{ number_format($payroll->overtime_pay ?? 0, 2) }}</td>
                    <td style="color:#0f172a; font-weight:600;">₱{{ number_format($payroll->gross_pay, 2) }}</td>
                    <td style="color:#dc2626;">-₱{{ number_format($payroll->sss ?? 0, 2) }}</td>
                    <td style="color:#dc2626;">-₱{{ number_format($payroll->philhealth ?? 0, 2) }}</td>
                    <td style="color:#dc2626;">-₱{{ number_format($payroll->hdmf ?? 0, 2) }}</td>
                    <td style="color:#dc2626;">-₱{{ number_format($payroll->tax ?? 0, 2) }}</td>
                    <td style="color:#dc2626;">-₱{{ number_format($payroll->total_deductions, 2) }}</td>
                    <td style="color:#059669; font-weight:600;">₱{{ number_format($payroll->net_pay, 2) }}</td>
                    <td>
                        <a href="#" class="employee-action-link">Payslip</a>
                    </td>
                </tr>
                @endforeach

                {{-- Totals row --}}
                <tr style="background:#f1f5f9; font-weight:600;">
                    <td colspan="3" style="padding:1rem 1.5rem; border-right:1px solid #cbd5e1; color:#0f172a;">TOTALS</td>
                    <td style="padding:1rem 1.5rem; border-right:1px solid #cbd5e1; color:#0f172a;">₱{{ number_format($payrolls->sum('basic_salary'), 2) }}</td>
                    <td style="padding:1rem 1.5rem; border-right:1px solid #cbd5e1; color:#0f172a;">₱{{ number_format($payrolls->sum('overtime_pay'), 2) }}</td>
                    <td style="padding:1rem 1.5rem; border-right:1px solid #cbd5e1; color:#0f172a;">₱{{ number_format($totalGross, 2) }}</td>
                    <td style="padding:1rem 1.5rem; border-right:1px solid #cbd5e1; color:#dc2626;">-₱{{ number_format($payrolls->sum('sss'), 2) }}</td>
                    <td style="padding:1rem 1.5rem; border-right:1px solid #cbd5e1; color:#dc2626;">-₱{{ number_format($payrolls->sum('philhealth'), 2) }}</td>
                    <td style="padding:1rem 1.5rem; border-right:1px solid #cbd5e1; color:#dc2626;">-₱{{ number_format($payrolls->sum('hdmf'), 2) }}</td>
                    <td style="padding:1rem 1.5rem; border-right:1px solid #cbd5e1; color:#dc2626;">-₱{{ number_format($payrolls->sum('tax'), 2) }}</td>
                    <td style="padding:1rem 1.5rem; border-right:1px solid #cbd5e1; color:#dc2626;">-₱{{ number_format($totalDeductions, 2) }}</td>
                    <td style="padding:1rem 1.5rem; border-right:1px solid #cbd5e1; color:#059669;">₱{{ number_format($totalNet, 2) }}</td>
                    <td style="padding:1rem 1.5rem;"></td>
                </tr>
            </tbody>
        </table>
    </div>
    @else
    {{-- No payroll records yet — show the employee list instead --}}
    <div class="employee-table-container">
        <div class="empty-payroll">
            <i data-lucide="inbox" style="width:40px; height:40px; margin-bottom:.75rem; opacity:.4;"></i>
            <p style="font-weight:600; margin-bottom:.25rem;">No payroll records found.</p>
            <p>Run payroll from the controller or use the Generate button to create records.</p>
        </div>

        {{-- Employee roster for reference --}}
        @if($employees->count())
        <table class="employee-table" id="payrollTable" style="font-size:0.75rem; margin-top:1rem;">
            <thead>
                <tr>
                    <th>Employee</th>
                    <th>Department</th>
                    <th>Position</th>
                    <th>Employment Status</th>
                    <th>Salary Rate</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $emp)
                @php
                    $name = trim($emp->first_name . ' ' . $emp->last_name);
                    $init = strtoupper(substr($name, 0, 1));
                @endphp
                <tr class="payroll-row"
                    data-name="{{ strtolower($name) }}"
                    data-dept="{{ $emp->department?->department_name ?? '' }}">
                    <td class="employee-id">
                        <div class="employee-name-cell">
                            <span class="employee-avatar">{{ $init }}</span>
                            <div><p class="employee-name">{{ $name }}</p></div>
                        </div>
                    </td>
                    <td>{{ $emp->department?->department_name ?? '—' }}</td>
                    <td>{{ $emp->position?->position_name ?? '—' }}</td>
                    <td>
                        <span class="badge {{ in_array($emp->employment_status, ['Regular', 'Probationary', 'Contractual']) ? 'badge-active' : 'badge-inactive' }}">
                            {{ $emp->employment_status ?? 'Unknown' }}
                        </span>
                    </td>
                    <td>₱{{ number_format($emp->salary_rate, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
    @endif

</div>
@endsection

@section('scripts')
<script>
    function filterTable() {
        const search = document.getElementById('payrollSearch').value.toLowerCase();
        const dept   = document.getElementById('deptFilter').value.toLowerCase();
        document.querySelectorAll('.payroll-row').forEach(row => {
            const nameMatch = row.dataset.name.includes(search);
            const deptMatch = dept === '' || row.dataset.dept.toLowerCase() === dept;
            row.style.display = (nameMatch && deptMatch) ? '' : 'none';
        });
    }
</script>
@endsection
