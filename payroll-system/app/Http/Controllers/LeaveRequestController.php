<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Leave_Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveRequestController extends Controller
{
    /**
     * Show the leave request form for the logged-in employee.
     */
    public function create()
    {
        $employee = Employee::with(['department', 'position'])
            ->where('user_id', Auth::id())
            ->first();

        return view('user.leave_form.leave_form', compact('employee'));
    }

    /**
     * Store a new leave request submitted by an employee.
     */
    public function store(Request $request)
    {
        $request->validate([
            'leave_type' => 'required|string',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date'   => 'required|date|after_or_equal:start_date',
            'reason'     => 'nullable|string|max:1000',
        ]);

        $employee = Employee::where('user_id', Auth::id())->firstOrFail();

        Leave_Request::create([
            'employee_id' => $employee->employee_id,
            'leave_type'  => $request->leave_type,
            'start_date'  => $request->start_date,
            'end_date'    => $request->end_date,
            'reason'      => $request->reason,
            'status'      => 'pending',
            'date_filed'  => now()->toDateString(),
        ]);

        return redirect()->route('user.leave_form')
            ->with('success', 'Leave request submitted successfully. Please wait for approval.');
    }

    /**
     * Admin: show all leave requests in the approval workflow.
     */
    public function index()
    {
        $leaveRequests = Leave_Request::with(['employee.department', 'employee.position', 'employee.user'])
            ->orderBy('date_filed', 'desc')
            ->get();

        return view('admin.approval_workflow.approval_workflow', compact('leaveRequests'));
    }

    /**
     * Admin: approve or reject a leave request.
     */
    public function updateStatus(Request $request, Leave_Request $leaveRequest)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $leaveRequest->update([
            'status'      => $request->status,
            'approved_by' => Auth::id(),
        ]);

        $label = ucfirst($request->status);
        return redirect()->route('approval_workflow.index')
            ->with('success', "Leave request {$label} successfully.");
    }
}
