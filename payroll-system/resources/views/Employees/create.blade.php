@extends('layouts.master')

@section('title', 'Create Employee - VIA Architects Associates')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="content-header">
        <div>
            <h2 class="header-title">Create New Employee</h2>
            <p class="header-subtitle">
                <span class="subtitle-dot"></span>
                Register a new staff member to the payroll system.
            </p>
        </div>
    </div>

    <form class="employee-form">
        <div class="form-grid">
            <!-- Left Column: Personal Info -->
            <div class="form-card">
                <div class="form-section-header">
                    <i data-lucide="user-plus" class="h-5 w-5 text-teal-400"></i>
                    <h3>Personal Information</h3>
                </div>
                <div class="form-group-stack">
                    <div class="form-group">
                        <label class="form-label">Name:</label>
                        <input type="text" class="form-input" placeholder="Full Name">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Employee Id:</label>
                        <input type="text" class="form-input" placeholder="VIA-2024-XXX">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Gender:</label>
                        <select class="form-select">
                            <option selected disabled>Select Gender</option>
                            <option>Male</option>
                            <option>Female</option>
                            <option>Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Contact Info:</label>
                        <input type="text" class="form-input" placeholder="Phone Number">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Address:</label>
                        <input type="text" class="form-input" placeholder="Current Address">
                    </div>
                    <div class="form-group">
                        <label class="form-label">SSS Num:</label>
                        <input type="text" class="form-input" placeholder="00-0000000-0">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Philhealth Nu:</label>
                        <input type="text" class="form-input" placeholder="00-000000000-0">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Join Date:</label>
                        <input type="date" class="form-input">
                    </div>
                    
                    <div class="form-actions-inline">
                        <button type="submit" class="btn-primary">Save</button>
                        <button type="reset" class="btn-secondary">Clear</button>
                    </div>
                </div>
            </div>

            <!-- Right Column: Avatar & Login -->
            <div class="form-side-column">
                <!-- Profile Picture Upload -->
                <div class="form-card avatar-card">
                    <div class="avatar-placeholder">
                        <i data-lucide="user" class="h-16 w-16 text-slate-700"></i>
                    </div>
                    <button type="button" class="btn-secondary w-full">
                        <i data-lucide="upload" class="h-4 w-4"></i>
                        Upload Photo
                    </button>
                </div>

                <!-- Account Login Info -->
                <div class="form-card">
                    <div class="form-section-header">
                        <i data-lucide="key" class="h-5 w-5 text-teal-400"></i>
                        <h3>Account Log In</h3>
                    </div>
                    <div class="form-group-stack">
                        <div class="form-group">
                            <label class="form-label">Email:</label>
                            <input type="email" class="form-input" placeholder="email@via-architects.com">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Password:</label>
                            <input type="password" class="form-input" placeholder="••••••••">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Confirm Password:</label>
                            <input type="password" class="form-input" placeholder="••••••••">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
