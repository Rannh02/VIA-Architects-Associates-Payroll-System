@extends('layouts.master')

@section('title', 'Departments')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/department.css') }}">
@endsection

@section('content')
<div class="department-container max-w-7xl mx-auto">
    <div class="department-header-container">
        <div class="header-content">
            <h2>Departments</h2>
            <p>Manage company departments</p>
        </div>
        <button class="btn-primary" onclick="openModal()">
            <i data-lucide="plus"></i> Add Department
        </button>
    </div>

    {{-- Success / Error Flash Messages --}}
    @if(session('success'))
        <div class="alert alert-success">
            <i data-lucide="check-circle"></i> {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-error">
            <i data-lucide="alert-circle"></i>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="department-table-container">
        <table class="department-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Department Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($departments as $index => $department)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><span class="badge badge-code">{{ $department->department_code }}</span></td>
                        <td class="font-medium">{{ $department->department_name }}</td>
                        <td>{{ $department->description ?? '—' }}</td>
                        <td>
                            <span class="badge {{ $department->status === 'Active' ? 'badge-active' : 'badge-inactive' }}">
                                {{ $department->status }}
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <form action="{{ route('department.destroy', $department->department_id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this department?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="department-action-link delete-link">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty-state">No departments found. Click <strong>Add Department</strong> to get started.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Add Department Modal --}}
<div id="departmentModal" class="modal-backdrop">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Add Department</h3>
            <button class="btn-close" onclick="closeModal()">
                <i data-lucide="x"></i>
            </button>
        </div>
        <form class="modal-form" action="{{ route('department.store') }}" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <label>Department Code <span class="required">*</span></label>
                    <input type="text" name="department_code" class="form-input"
                           placeholder="e.g. HR" value="{{ old('department_code') }}" required>
                </div>
                <div class="form-group">
                    <label>Department Name <span class="required">*</span></label>
                    <input type="text" name="department_name" class="form-input"
                           placeholder="e.g. Human Resources" value="{{ old('department_name') }}" required>
                </div>
            </div>
            <div class="form-group-full">
                <label>Description</label>
                <input type="text" name="description" class="form-input"
                       placeholder="Brief description" value="{{ old('description') }}">
            </div>
            <div class="form-group-full half-width">
                <label>Status <span class="required">*</span></label>
                <select name="status" class="form-select" required>
                    <option value="Active" {{ old('status') === 'Active' ? 'selected' : '' }}>Active</option>
                    <option value="Inactive" {{ old('status') === 'Inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="closeModal()">Cancel</button>
                <button type="submit" class="btn-primary">Save Department</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function openModal() {
        document.getElementById('departmentModal').classList.add('show');
        if(typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    }

    function closeModal() {
        document.getElementById('departmentModal').classList.remove('show');
    }

    window.onclick = function(event) {
        const modal = document.getElementById('departmentModal');
        if (event.target == modal) {
            closeModal();
        }
    }

    // Re-open modal if there are validation errors
    @if($errors->any())
        document.addEventListener('DOMContentLoaded', () => openModal());
    @endif
</script>
@endsection