<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Payroll;
use App\Models\Leave_Request;
use App\Models\Department;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEmployees = Employee::count();
        $payrollsProcessed = Payroll::count();
        $pendingApprovals = Leave_Request::where('status', 'Pending')->count();
        $totalDepartments = Department::count();

        // Get recent leave requests for the activity feed
        $recentActivities = Leave_Request::with('employee')
            ->latest('created_at')
            ->take(5)
            ->get();

        return view('admin.dashboard.index', compact(
            'totalEmployees',
            'payrollsProcessed',
            'pendingApprovals',
            'totalDepartments',
            'recentActivities'
        ));
    }
}
