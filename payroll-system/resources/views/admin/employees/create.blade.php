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

        @if($errors->has('error'))
            <div style="background:#fee2e2;color:#991b1b;border:1px solid #fecaca;padding:12px 16px;border-radius:8px;margin-bottom:16px;display:flex;align-items:center;gap:8px;">
                <i data-lucide="alert-circle" class="h-4 w-4"></i> {{ $errors->first('error') }}
            </div>
        @endif

        <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data" class="employee-form">
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
                                class="form-input"
                                value="{{ $nextEmployeeId }}" readonly
                                style="background-color: #f3f4f6; cursor: not-allowed;">
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
                                <label class="form-label">Middle Name:</label>
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

                                    <option value="Male" {{ old('sex') === 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('sex') === 'Female' ? 'selected' : '' }}>Female</option>
                                </select>
                                @error('sex')
                                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row-2">
                            <div class="form-group">
                                <label class="form-label">Contact Number:</label>
                                <input type="text" name="phone" class="form-input" placeholder="09XX-XXX-XXXX"
                                    value="{{ old('phone') }}">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Date of Birth:</label>
                                <input type="date" name="date_of_birth" class="form-input"
                                    value="{{ old('date_of_birth') }}">

                            </div>
                        </div>

                        <div class="form-row-2">
                            <div class="form-froup">
                                <lable class="form-label">Marital Status:</lable>
                                <select name="marital_status" class="form-select">
                                    <option value="" disabled selected>Select Marital Status</option>
                                    <option value="Single" {{ old('marital_status') === 'Single' ? 'selected' : '' }}>Single
                                    </option>
                                    <option value="Married" {{ old('marital_status') === 'Married' ? 'selected' : '' }}>
                                        Married</option>
                                    <option value="Widowed" {{ old('marital_status') === 'Widowed' ? 'selected' : '' }}>
                                        Widowed</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Number of Dependents:</label>
                                <input type="number" name="dependents" class="form-input"
                                    placeholder="Enter Number of Dependents" value="{{ old('dependents') }}">
                            </div>
                        </div>

                        <div class="form-row-2">
                            <div class="form-group">
                                <label class="form-label">Basic Salary</label>
                                <input type="number" id="salary_input" name="salary" class="form-input"
                                    placeholder="Auto-filled from position"
                                    value="{{ old('salary') }}" readonly
                                    style="background: var(--input-bg, #f9fafb); cursor: not-allowed; opacity: 0.85;">
                                <!-- <small style="color: var(--text-muted, #6b7280); font-size: 0.75rem; margin-top: 4px; display:block;">
                                    Salary is set by the selected position.
                                </small> -->
                            </div>

                            <div class="form-group">
                                <label class="form-label">Position</label>
                                <select id="position_select" name="position" class="form-select">
                                    <option value="" disabled selected>Select Position</option>
                                    @foreach($positions as $pos)
                                        <option value="{{ $pos->position_id }}"
                                            data-salary="{{ $pos->basic_salary }}"
                                            {{ old('position') == $pos->position_id ? 'selected' : '' }}>
                                            {{ $pos->position_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-row-2">
                            <div class="form-group">
                                <label class="form-label">Department</label>
                                <select name="department" class="form-select">
                                    <option value="" disabled selected>Select Department</option>
                                    @foreach($departments as $dept)
                                        <option value="{{ $dept->department_id }}" {{ old('department') == $dept->department_id ? 'selected' : '' }}>{{ $dept->department_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Employee Status</label>
                                <select name="employee_status" class="form-select">
                                    <option value="" disabled selected>Select Employee Status</option>
                                    <option value="Regular" {{ old('employee_status') === 'Regular' ? 'selected' : '' }}>
                                        Regular</option>
                                    <option value="Probationary" {{ old('employee_status') === 'Probationary' ? 'selected' : '' }}>Probationary</option>
                                    <option value="Contractual" {{ old('employee_status') === 'Contractual' ? 'selected' : '' }}>Contractual</option>
                                </select>
                            </div>
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
                                <label class="form-label">SSS Number:</label>
                                <input type="text" name="sss_num" class="form-input" placeholder="00-0000000-0"
                                    value="{{ old('sss_num') }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Philhealth Number:</label>
                                <input type="text" name="philhealth_num" class="form-input" placeholder="00-000000000-0"
                                    value="{{ old('philhealth_num') }}">
                            </div>
                        </div>

                        <div class="form-row-2">
                            <div class="form-group">
                                <label class="form-label">Pag-ibig</label>
                                <input type="text" name="pagibig_num" class="form-input" placeholder="0000-0000-0000"
                                    value="{{ old('pagibig_num') }}">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Join Date:</label>
                                <input type="date" name="join_date" class="form-input" value="{{ old('join_date') }}">
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Right Column: Avatar & Login -->
                <div class="form-side-column">
                    <!-- Profile Picture Upload -->
                    <div class="form-card avatar-card">
                        <div class="avatar-placeholder" id="avatar_preview_container">
                            <i data-lucide="user" class="h-16 w-16 text-slate-700" id="avatar_icon"></i>
                            <img id="avatar_preview" class="hidden h-full w-full object-cover rounded-xl" src="" alt="Preview">
                        </div>
                        <input type="file" name="profile_photo" id="profile_photo_input" accept="image/*" style="display: none;">
                        <button type="button" class="btn-secondary w-full" id="upload_photo_btn">
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

            <!-- Form Actions at the Bottom -->
            <div class="form-actions-footer">
                <button type="submit" class="btn-primary px-8 py-3">
                    <i data-lucide="save" class="h-5 w-5"></i>
                    Save Employee Record
                </button>
                <button type="reset" class="btn-secondary px-8 py-3">
                    <i data-lucide="rotate-ccw" class="h-5 w-5"></i>
                    Clear Form
                </button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            // --- Copy current address to permanent address ---
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

                // Also sync live while typing in current fields
                const currentFields = ['street_address', 'barangay', 'city', 'province', 'zip_code'];
                currentFields.forEach(field => {
                    const input = document.querySelector(`[name="current_${field}"]`);
                    if (input) {
                        input.addEventListener('input', () => {
                            if (sameAsCurrent.checked) {
                                document.querySelector(`[name="permanent_${field}"]`).value = input.value;
                            }
                        });
                    }
                });
            }

            // --- Auto-fill Basic Salary from selected Position ---
            const positionSelect = document.getElementById('position_select');
            const salaryInput    = document.getElementById('salary_input');

            function syncSalary() {
                const selected = positionSelect.options[positionSelect.selectedIndex];
                salaryInput.value = selected?.dataset?.salary ?? '';
            }

            if (positionSelect && salaryInput) {
                positionSelect.addEventListener('change', syncSalary);
                // Restore salary on validation re-open (old value present)
                if (positionSelect.value) syncSalary();
            }
            // --- End salary auto-fill ---

            // --- Photo Upload Preview ---
            const uploadBtn = document.getElementById('upload_photo_btn');
            const photoInput = document.getElementById('profile_photo_input');
            const avatarIcon = document.getElementById('avatar_icon');
            const avatarPreview = document.getElementById('avatar_preview');

            if (uploadBtn && photoInput) {
                uploadBtn.addEventListener('click', () => photoInput.click());

                photoInput.addEventListener('change', function() {
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            avatarPreview.src = e.target.result;
                            avatarPreview.classList.remove('hidden');
                            avatarIcon.classList.add('hidden');
                        }
                        reader.readAsDataURL(file);
                    }
                });
            }
            // --- End Photo Upload Preview ---

        });
    </script>
@endsection