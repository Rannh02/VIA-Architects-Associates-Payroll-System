<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\SssController;
use App\Http\Controllers\PhilhealthController;
use App\Http\Controllers\PagibigController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return "Registration Page Placeholder";
})->name('register');

Route::get('/password-reset', function () {
    return view('auth.forgot-password');
})->name('password.request');

Route::post('/password-email', function () {
    return "Password Reset Link Sent Placeholder";
})->name('password.email');

Route::post('/login', function (Illuminate\Http\Request $request) {
    \Illuminate\Support\Facades\Log::info('Login attempt for: ' . $request->email);

    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Illuminate\Support\Facades\Auth::attempt($credentials)) {
        \Illuminate\Support\Facades\Log::info('Login successful for: ' . $request->email);
        $request->session()->regenerate();

        $user = Illuminate\Support\Facades\Auth::user();
        if ($user->role === 'admin') {
            return redirect()->intended(route('dashboard'));
        }

        return redirect()->intended(route('user.dashboard'));
    }

    \Illuminate\Support\Facades\Log::warning('Login failed for: ' . $request->email);
    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // route for user dashboard all in sidebar
    Route::get('/user-dashboard', [DashboardController::class, 'userIndex'])->name('user.dashboard');

    Route::get('/attendance', function () {
        return view('user.attendance.index');
    })->name('user.attendance');

    Route::get('/payslip', function () {
        return view('user.payslip.payslip');
    })->name('user.payslip');

    Route::get('/leave_form', [LeaveController::class, 'showForm'])->name('user.leave_form');
    Route::post('/leave_form', [LeaveController::class, 'store'])->name('user.leave_form.store');

    Route::get('/my-requests', [LeaveRequestController::class, 'myRequests'])->name('user.my_requests');


    // route for employee controller
    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/employees/archived', [EmployeeController::class, 'archived'])->name('employees.archived');
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::post('/employees/{id}/restore', [EmployeeController::class, 'restore'])->name('employees.restore');
    Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');

    // route for department controller
    Route::get('/department/index', [DepartmentController::class, 'index'])->name('department.index');
    Route::post('/department', [DepartmentController::class, 'store'])->name('department.store');
    Route::delete('/department/{department}', [DepartmentController::class, 'destroy'])->name('department.destroy');

    // route for position controller
    Route::get('/positions/index', [PositionController::class, 'index'])->name('position.index');
    Route::post('/positions', [PositionController::class, 'store'])->name('position.store');
    Route::delete('/positions/{position}', [PositionController::class, 'destroy'])->name('position.destroy');

    // route for sss controller
    Route::get('/sss/index', [SssController::class, 'index'])->name('sss.index');
    Route::post('/sss', [SssController::class, 'store'])->name('sss.store');
    Route::put('/sss/{sss}', [SssController::class, 'update'])->name('sss.update');
    Route::delete('/sss/{sss}', [SssController::class, 'destroy'])->name('sss.destroy');

    //route for philhealth controller
    Route::get('/philhealth/index', [PhilhealthController::class, 'index'])->name('philhealth.index');
    Route::post('/philhealth', [PhilhealthController::class, 'store'])->name('philhealth.store');
    Route::put('/philhealth/{philhealth}', [PhilhealthController::class, 'update'])->name('philhealth.update');
    Route::delete('/philhealth/{philhealth}', [PhilhealthController::class, 'destroy'])->name('philhealth.destroy');

    //route for pagibig controller
    Route::get('/pagibig/index', [PagibigController::class, 'index'])->name('pagibig.index');
    Route::post('/pagibig', [PagibigController::class, 'store'])->name('pagibig.store');
    Route::put('/pagibig/{pagibig}', [PagibigController::class, 'update'])->name('pagibig.update');
    Route::delete('/pagibig/{pagibig}', [PagibigController::class, 'destroy'])->name('pagibig.destroy');

    //route for tax controller
    Route::get('/tax/index', [TaxController::class, 'index'])->name('tax.index');
    Route::post('/tax', [TaxController::class, 'store'])->name('tax.store');
    Route::put('/tax/{tax}', [TaxController::class, 'update'])->name('tax.update');
    Route::delete('/tax/{tax}', [TaxController::class, 'destroy'])->name('tax.destroy');

    Route::get('/payroll', [PayrollController::class, 'index'])->name('payroll.index');

    Route::get('/approval_workflow', [LeaveRequestController::class, 'index'])->name('approval_workflow.index');
    Route::patch('/approval_workflow/{leaveRequest}/status', [LeaveRequestController::class, 'updateStatus'])->name('approval_workflow.status');

    Route::get('/reports', function () {
        return view('admin.reports.reports');
    })->name('reports.index');

    Route::get('/profile/settings', function () {
        if (Auth::user()->role === 'admin') {
            return view('admin.settings.index');
        }
        return view('user.settings.index');
    })->name('profile.settings');
});

Route::post('/profile/photo', [App\Http\Controllers\ProfileController::class, 'updatePhoto'])->name('profile.photo.update');

Route::post('/logout', function (Illuminate\Http\Request $request) {
    Illuminate\Support\Facades\Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login');
})->name('logout');
