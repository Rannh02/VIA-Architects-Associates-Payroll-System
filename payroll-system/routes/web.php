<?php

use Illuminate\Support\Facades\Route;

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

    Route::get('/user-dashboard', function () {
        return view('user.dashboard.index');
    })->name('user.dashboard');

    Route::get('/employees/create', function () {
        return view('admin.employees.create');
    })->name('employees.create');

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
