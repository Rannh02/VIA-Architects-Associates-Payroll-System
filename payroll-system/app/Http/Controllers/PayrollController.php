<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\Payroll;

class PayrollController extends Controller
{
    public function index()
    {
        $employees = Employee::with(['department', 'position'])->get();

        $payrolls = Payroll::with('employee')->latest()->get();

        return view('admin.employees.payroll_run', compact('employees', 'payrolls'));
    }

    public function generate(Request $request)
    {
        $request->validate([
            'from' => 'required|date',
            'to' => 'required|date',
        ]);

        $from = $request->from;
        $to = $request->to;

        $employees = Employee::where('status', 'active')->get();

        return view('admin.payroll.summary', compact(
            'employees',
            'from',
            'to'
        ));
    }

    public function runForEmployee(Employee $employee, $from, $to)
    {
        // Fetch Attendances
        $attendances = Attendance::where('employee_id', $employee->id)
            ->whereBetween('date', [$from, $to])
            ->get();

        // Calculate Working Days & Absences
        $daysWorked = $attendances
            ->where('status', 'Present')
            ->count();

        $absentDays = $attendances
            ->where('status', 'Absent')
            ->count();

        $totalLateMinutes = $attendances->sum('late_minutes');

        $totalUndertimeMinutes = $attendances->sum('undertime_minutes');

        // Salary Rates
        $dailyRate = $employee->daily_rate;
        $hourlyRate = $dailyRate / 8;
        $minuteRate = $hourlyRate / 60;

        // Earnings
        $basicSalary = $dailyRate * $daysWorked;

        // Deductions
        $absenceDeduction = $dailyRate * $absentDays;

        $lateDeduction = $minuteRate * $totalLateMinutes;

        $undertimeDeduction = $minuteRate * $totalUndertimeMinutes;

        // Government Contributions
        $sss = 300;
        $philhealth = 200;
        $hdmf = 100;
        $tax = 500;

        $totalDeductions =
            $absenceDeduction +
            $lateDeduction +
            $undertimeDeduction +
            $sss +
            $philhealth +
            $hdmf +
            $tax;

        $grossSalary = $basicSalary;

        $netPay = $grossSalary - $totalDeductions;

        // Save Payroll
        $payroll = Payroll::create([
            'employee_id' => $employee->id,
            'from_date' => $from,
            'to_date' => $to,
            'days_worked' => $daysWorked,
            'absent_days' => $absentDays,
            'late_minutes' => $totalLateMinutes,
            'undertime_minutes' => $totalUndertimeMinutes,
            'gross_salary' => $grossSalary,
            'total_deductions' => $totalDeductions,
            'net_pay' => $netPay,
            'sss' => $sss,
            'philhealth' => $philhealth,
            'hdmf' => $hdmf,
            'tax' => $tax,
        ]);

        return view('admin.payroll.payslip', compact(
            'employee',
            'payroll'
        ));
    }
}
