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
                            <label class="form-label">Employee ID:</label>
                            <input type="text" name="employee_id"
                                class="form-input @error('employee_id') border-rose-500 @enderror"
                                placeholder="VIA-2024-XXX" value="{{ old('employee_id') }}">
                            @error('employee_id')
                                <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-row-2">
                            <div class="form-group">
                                <label class="form-label">First Name:</label>
                                <input type="text" name="first_name"
                                    class="form-input @error('first_name') border-rose-500 @enderror"
                                    placeholder="Enter First Name" value="{{ old('first_name') }}">
                                @error('first_name')
                                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Middle Name (Optional):</label>
                                <input type="text" name="middle_name"
                                    class="form-input @error('middle_name') border-rose-500 @enderror"
                                    placeholder="Enter Middle Name" value="{{ old('middle_name') }}">
                                @error('middle_name')
                                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row-2">
                            <div class="form-group">
                                <label class="form-label">Last Name:</label>
                                <input type="text" name="last_name"
                                    class="form-input @error('last_name') border-rose-500 @enderror"
                                    placeholder="Enter Last Name" value="{{ old('last_name') }}">
                                @error('last_name')
                                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Sex:</label>
                                <select name="sex" class="form-select @error('sex') border-rose-500 @enderror">
                                    <option selected disabled>Sex</option>
                                    <option value="Male" {{ old('sex') === 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('sex') === 'Female' ? 'selected' : '' }}>Female</option>
                                </select>
                                @error('sex')
                                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Contact Number:</label>
                            <input type="text" name="phone" class="form-input" placeholder="09XX-XXX-XXXX"
                                value="{{ old('phone') }}">
                        </div>

                        <!-- Current Address Section -->
                        <div class="form-subsection-header">
                            <span class="form-subsection-title">Current Address</span>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Street Address:</label>
                            <input type="text" name="current_street_address" class="form-input"
                                placeholder="House No., Street, Subdivision" value="{{ old('current_street_address') }}">
                        </div>

                        <div class="form-row-2">
                            <div class="form-group">
                                <label class="form-label">Barangay:</label>
                                <input type="text" name="current_barangay" class="form-input" placeholder="Enter Barangay"
                                    value="{{ old('current_barangay') }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">City/Municipality:</label>
                                <input type="text" name="current_city" class="form-input"
                                    placeholder="Enter City/Municipality" value="{{ old('current_city') }}">
                            </div>
                        </div>

                        <div class="form-row-2">
                            <div class="form-group">
                                <label class="form-label">Province:</label>
                                <input type="text" name="current_province" class="form-input" placeholder="Enter Province"
                                    value="{{ old('current_province') }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">ZIP Code:</label>
                                <input type="text" name="current_zip_code" class="form-input" placeholder="Enter ZIP Code"
                                    value="{{ old('current_zip_code') }}">
                            </div>
                        </div>

                        <!-- Permanent Address Section -->
                        <div class="form-subsection-header">
                            <span class="form-subsection-title">Permanent Address (Old Address)</span>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Street Address:</label>
                            <input type="text" name="permanent_street_address" class="form-input"
                                placeholder="House No., Street, Subdivision" value="{{ old('permanent_street_address') }}">
                        </div>

                        <div class="form-row-2">
                            <div class="form-group">
                                <label class="form-label">Barangay:</label>
                                <input type="text" name="permanent_barangay" class="form-input" placeholder="Enter Barangay"
                                    value="{{ old('permanent_barangay') }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">City/Municipality:</label>
                                <input type="text" name="permanent_city" class="form-input"
                                    placeholder="Enter City/Municipality" value="{{ old('permanent_city') }}">
                            </div>
                        </div>

                        <div class="form-row-2">
                            <div class="form-group">
                                <label class="form-label">Province:</label>
                                <input type="text" name="permanent_province" class="form-input" placeholder="Enter Province"
                                    value="{{ old('permanent_province') }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">ZIP Code:</label>
                                <input type="text" name="permanent_zip_code" class="form-input" placeholder="Enter ZIP Code"
                                    value="{{ old('permanent_zip_code') }}">
                            </div>
                        </div>

                        <!-- Government Identifiers -->
                        <div class="form-subsection-header" style="margin-top: 2rem;">
                            <span class="form-subsection-title">Government IDs & Employment</span>
                        </div>

                        <div class="form-row-2">
                            <div class="form-group">
                                <label class="form-label">SSS Num:</label>
                                <input type="text" name="sss_num" class="form-input" placeholder="00-0000000-0"
                                    value="{{ old('sss_num') }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Philhealth Num:</label>
                                <input type="text" name="philhealth_num" class="form-input" placeholder="00-000000000-0"
                                    value="{{ old('philhealth_num') }}">
                            </div>
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
                                <input type="email" name="email"
                                    class="form-input @error('email') border-rose-500 @enderror"
                                    placeholder="email@via-architects.com" value="{{ old('email') }}">
                                @error('email')
                                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Password:</label>
                                <input type="password" name="password"
                                    class="form-input @error('password') border-rose-500 @enderror" placeholder="••••••••">
                                @error('password')
                                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Confirm Password:</label>
                                <input type="password" name="password_confirmation" class="form-input"
                                    placeholder="••••••••">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sameAsCurrent = document.getElementById('same_as_current');
            if (sameAsCurrent) {
                sameAsCurrent.addEventListener('change', () => {
                    if (sameAsCurrent.checked) {
                        const fields = ['street_address', 'barangay', 'city', 'province', 'zip_code'];
                        fields.forEach(field => {
                            const currentVal = document.querySelector(`[name="current_${field}"]`).value;
                            document.querySelector(`[name="permanent_${field}"]`).value = currentVal;
                        });
                    }
                });

                // Update permanent fields when current fields change, if checkbox is checked
                const currentFields = ['street_address', 'barangay', 'city', 'province', 'zip_code'];
                currentFields.forEach(field => {
                    const input = document.querySelector(`[name="current_${field}"]`);
                    input.addEventListener('input', () => {
                        if (sameAsCurrent.checked) {
                            document.querySelector(`[name="permanent_${field}"]`).value = input.value;
                        }
                    });
                });
            }
        });
    </script>
@endsection