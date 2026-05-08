<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with(['department', 'position', 'user'])->get();
        return view('admin.employees.manage_employee', compact('employees'));
    }

    public function create()
    {
        $departments = Department::all();
        $positions = Position::all();
        
        // Calculate next employee number
        $latestEmployee = Employee::orderBy('employee_id', 'desc')->first();
        $nextId = $latestEmployee ? $latestEmployee->employee_id + 1 : 1;
        $nextEmployeeId = 'VIA-' . date('Y') . '-' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

        return view('admin.employees.create', compact('departments', 'positions', 'nextEmployeeId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'first_name' => 'required|string|max:50',
            'middle_name' => 'nullable|string|max:50',
            'last_name' => 'required|string|max:50',
            'sex' => 'nullable|in:Male,Female',
            'current_street_address' => 'nullable|string|max:255',
            'current_barangay' => 'nullable|string|max:100',
            'current_city' => 'nullable|string|max:100',
            'current_province' => 'nullable|string|max:100',
            'current_zip_code' => 'nullable|string|max:10',
            'permanent_street_address' => 'nullable|string|max:255',
            'permanent_barangay' => 'nullable|string|max:100',
            'permanent_city' => 'nullable|string|max:100',
            'permanent_province' => 'nullable|string|max:100',
            'permanent_zip_code' => 'nullable|string|max:10',
            'phone' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
            'salary' => 'nullable|numeric|min:0',
            'join_date' => 'nullable|date',
            'employee_status' => 'nullable|string|max:50',
            'marital_status' => 'nullable|string|max:50',
            'dependents' => 'nullable|integer|min:0',
            'sss_num' => 'nullable|string|max:50',
            'philhealth_num' => 'nullable|string|max:50',
            'pagibig_num' => 'nullable|string|max:50',
            'position' => 'nullable|exists:position,position_id',
            'department' => 'nullable|exists:department,department_id',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            DB::transaction(function () use ($request) {
                // Handle photo upload
                $photoPath = null;
                if ($request->hasFile('profile_photo')) {
                    $photoPath = $request->file('profile_photo')->store('profile-photos', 'public');
                }

                // Create the User account for login
                $user = User::create([
                    'name' => trim($request->first_name . ' ' . $request->last_name),
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role' => 'user',
                    'profile_photo_path' => $photoPath,
                ]);

                // Create the Employee record
                Employee::create([
                    'employee_number' => $request->employee_id, // This comes from the readonly input
                    'user_id' => $user->id,
                    'created_by' => auth()->id(),
                    'first_name' => $request->first_name,
                    'middle_name' => $request->middle_name,
                    'last_name' => $request->last_name,
                    'sex' => $request->sex,
                    
                    'current_street_address' => $request->current_street_address,
                    'current_barangay' => $request->current_barangay,
                    'current_city_municipality' => $request->current_city,
                    'current_province' => $request->current_province,
                    'current_zip_code' => $request->current_zip_code,
                    
                    'permanent_street_address' => $request->permanent_street_address,
                    'permanent_barangay' => $request->permanent_barangay,
                    'permanent_city_municipality' => $request->permanent_city,
                    'permanent_province' => $request->permanent_province,
                    'permanent_zip_code' => $request->permanent_zip_code,

                    'contact_info' => $request->phone,
                    'date_of_birth' => $request->date_of_birth,
                    
                    'salary_rate' => $request->salary,
                    'hire_date' => $request->join_date,
                    
                    'employment_status' => $request->employee_status,
                    'marital_status' => $request->marital_status,
                    'number_of_dependents' => $request->dependents ?: 0,
                    
                    'sss_num' => $request->sss_num,
                    'philhealth_num' => $request->philhealth_num,
                    'pagibig_num' => $request->pagibig_num,
                    
                    'position_id' => $request->position,
                    'department_id' => $request->department,
                ]);

                \Log::info('Employee created successfully for user: ' . $user->email);
            });
        } catch (\Exception $e) {
            \Log::error('Failed to create employee: ' . $e->getMessage());
            return back()->withInput()->withErrors(['error' => 'Failed to create employee: ' . $e->getMessage()]);
        }

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    // Other methods (edit, update, destroy) can be implemented similarly using Blade views
    public function edit(Employee $employee)
    {
        $departments = Department::all();
        $positions = Position::all();
        return view('admin.employees.edit', compact('employee', 'departments', 'positions'));
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}   
