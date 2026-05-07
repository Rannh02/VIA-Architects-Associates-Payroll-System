<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;

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
    Route::get('/dashboard', function () {
        return view('admin.dashboard.index');
    })->name('dashboard');

    // route for user dashboard all in sidebar
    Route::get('/user-dashboard', function () {
        return view('user.dashboard.index');
    })->name('user.dashboard');

    Route::get('/attendance', function () {
        return view('user.attendance.index');
    })->name('user.attendance');

    Route::get('/payslip', function () {
        return view('user.payslip.payslip');
    })->name('user.payslip');

    Route::get('/leave_form', function () {
        return view("user.leave_form.leave_form");
    })->name('user.leave_form');


   // route for employee controller
    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');

    // route for department controller
    Route::get('/department/index', [DepartmentController::class, 'index'])->name('department.index');
    Route::post('/department', [DepartmentController::class, 'store'])->name('department.store');
    Route::delete('/department/{department}', [DepartmentController::class, 'destroy'])->name('department.destroy');

    // route for position controller
    Route::get('/positions/index', [PositionController::class, 'index'])->name('position.index');
    Route::post('/positions', [PositionController::class, 'store'])->name('position.store');
    Route::delete('/positions/{position}', [PositionController::class, 'destroy'])->name('position.destroy');


    Route::get('/payroll', function () {
        return view('admin.employees.payroll_run');
    })->name('payroll.index');

    Route::get('/approval_workflow', function () {
        return view('admin.approval_workflow.approval_workflow');
    })->name('approval_workflow.index');

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
