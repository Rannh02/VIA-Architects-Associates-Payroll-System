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

    <form action="#" method="POST" class="employee-form">
        @csrf
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
                        <input type="text" name="name" class="form-input @error('name') border-rose-500 @enderror" placeholder="Full Name" value="{{ old('name') }}">
                        @error('name')
                            <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Employee Id:</label>
                        <input type="text" name="employee_id" class="form-input @error('employee_id') border-rose-500 @enderror" placeholder="VIA-2024-XXX" value="{{ old('employee_id') }}">
                        @error('employee_id')
                            <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Gender:</label>
                        <select name="gender" class="form-select @error('gender') border-rose-500 @enderror">
                            <option selected disabled>Select Gender</option>
                            <option value="Male" {{ old('gender') === 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender') === 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ old('gender') === 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('gender')
                            <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Contact Info:</label>
                        <input type="text" name="phone" class="form-input" placeholder="Phone Number" value="{{ old('phone') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Address:</label>
                        <input type="text" name="address" class="form-input" placeholder="Current Address" value="{{ old('address') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">SSS Num:</label>
                        <input type="text" name="sss_num" class="form-input" placeholder="00-0000000-0" value="{{ old('sss_num') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Philhealth Num:</label>
                        <input type="text" name="philhealth_num" class="form-input" placeholder="00-000000000-0" value="{{ old('philhealth_num') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Join Date:</label>
                        <input type="date" name="join_date" class="form-input" value="{{ old('join_date') }}">
                    </div>
                    
                    <div class="form-actions-inline">
                        <button type="submit" class="btn-primary">Save Employee</button>
                        <button type="reset" class="btn-secondary">Clear Form</button>
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
                            <input type="email" name="email" class="form-input @error('email') border-rose-500 @enderror" placeholder="email@via-architects.com" value="{{ old('email') }}">
                            @error('email')
                                <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Password:</label>
                            <input type="password" name="password" class="form-input @error('password') border-rose-500 @enderror" placeholder="••••••••">
                            @error('password')
                                <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Confirm Password:</label>
                            <input type="password" name="password_confirmation" class="form-input" placeholder="••••••••">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
