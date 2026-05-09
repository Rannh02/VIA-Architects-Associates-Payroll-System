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
                                <button type="button" 
                                        class="department-action-link delete-link" 
                                        onclick="openDeleteModal('{{ $department->department_id }}', '{{ $department->department_name }}')">
                                    Delete
                                </button>
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

    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="delete-modal" class="modal-overlay">
    <div class="modal-content-delete">
        <div class="modal-inner">
            <div class="modal-top">
                <div class="modal-icon-container">
                    <i data-lucide="alert-triangle" class="h-6 w-6"></i>
                </div>
                <div class="modal-info">
                    <h3 class="modal-title">Delete Department</h3>
                    <p class="modal-description">
                        Are you sure you want to delete <strong id="delete-item-name" style="color: inherit; font-weight: 700;"></strong>? 
                        This action cannot be undone and may affect associated records.
                    </p>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn-modal btn-modal-secondary" onclick="closeDeleteModal()">Cancel</button>
            <form id="delete-form" method="POST" style="margin: 0;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-modal btn-modal-danger">Delete Department</button>
            </form>
        </div>
    </div>
</div>

<style>
    /* Professional Modal Styles */
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.4);
        backdrop-filter: blur(4px);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 1100;
        opacity: 0;
        transition: all 0.2s ease-out;
    }
    .modal-overlay.show {
        display: flex;
        opacity: 1;
    }
    .modal-content-delete {
        background: white;
        width: 95%;
        max-width: 440px;
        border-radius: 1rem;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        transform: scale(0.95);
        transition: all 0.2s ease-out;
        border: 1px solid #e2e8f0;
        overflow: hidden;
    }
    .modal-overlay.show .modal-content-delete {
        transform: scale(1);
    }
    .modal-inner {
        padding: 1.5rem;
    }
    .modal-top {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        margin-bottom: 1.25rem;
    }
    .modal-icon-container {
        flex-shrink: 0;
        width: 2.75rem;
        height: 2.75rem;
        background: #fee2e2;
        color: #dc2626;
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .modal-info {
        flex: 1;
    }
    .modal-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: #0f172a;
        margin-bottom: 0.375rem;
    }
    .modal-description {
        color: #64748b;
        font-size: 0.875rem;
        line-height: 1.5;
    }
    .modal-footer {
        background: #f8fafc;
        padding: 1rem 1.5rem;
        display: flex;
        justify-content: flex-end;
        gap: 0.75rem;
        border-top: 1px solid #e2e8f0;
    }
    .btn-modal {
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        font-weight: 600;
        font-size: 0.875rem;
        cursor: pointer;
        transition: all 0.15s;
        border: 1px solid transparent;
    }
    .btn-modal-secondary {
        background: white;
        border-color: #e2e8f0;
        color: #475569;
    }
    .btn-modal-secondary:hover {
        background: #f1f5f9;
        border-color: #cbd5e1;
    }
    .btn-modal-danger {
        background: #dc2626;
        color: white;
    }
    .btn-modal-danger:hover {
        background: #b91c1c;
    }

    /* Dark Mode */
    .dark-mode .modal-content-delete {
        background: #1e293b;
        border-color: #334155;
    }
    .dark-mode .modal-inner { background: #1e293b; }
    .dark-mode .modal-title { color: #f8fafc; }
    .dark-mode .modal-description { color: #94a3b8; }
    .dark-mode .modal-footer { background: #0f172a; border-color: #334155; }
    .dark-mode .modal-icon-container { background: rgba(220, 38, 38, 0.1); }
    .dark-mode .btn-modal-secondary { background: #1e293b; border-color: #334155; color: #f8fafc; }
    .dark-mode .btn-modal-secondary:hover { background: #334155; }
</style>
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

    // Delete Modal Logic
    function openDeleteModal(id, name) {
        const modal = document.getElementById('delete-modal');
        const form = document.getElementById('delete-form');
        const nameDisplay = document.getElementById('delete-item-name');
        
        form.action = `/department/${id}`; // Adjust based on your actual route
        nameDisplay.textContent = name;
        
        modal.classList.add('show');
        if (window.lucide) {
            window.lucide.createIcons();
        }
    }

    function closeDeleteModal() {
        document.getElementById('delete-modal').classList.remove('show');
    }

    window.onclick = function(event) {
        const addModal = document.getElementById('departmentModal');
        const deleteModal = document.getElementById('delete-modal');
        if (event.target == addModal) closeModal();
        if (event.target == deleteModal) closeDeleteModal();
    }

    // Close on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
            closeDeleteModal();
        }
    });

    // Re-open modal if there are validation errors
    @if($errors->any())
        document.addEventListener('DOMContentLoaded', () => openModal());
    @endif
</script>
@endsection