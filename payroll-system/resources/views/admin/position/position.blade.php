@extends('layouts.master')

@section('title', 'Positions')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/position.css') }}">
@endsection

@section('content')
<div class="position-container max-w-7xl mx-auto">
    <div class="position-header-container">
        <div class="header-content">
            <h2>Positions</h2>
            <p>Manage job positions per department</p>
        </div>
        <button class="btn-primary" onclick="openModal()">
            <i data-lucide="plus"></i> Add Position
        </button>
    </div>

    <div class="position-table-container">
        <table class="position-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Position name</th>
                    <th>Department</th>
                    <th>Description</th>
                    <th>Basic Salary</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($positions as $index => $position)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><span class="badge badge-code">{{ $position->position_code }}</span></td>
                    <td class="font-medium">{{ $position->position_name }}</td>
                    <td><span class="badge badge-hr">{{ $position->department->department_name ?? '—' }}</span></td>
                    <td>{{ $position->description ?? '__' }}</td>
                    <td>{{ $position->basic_salary }}</td>
                    <td>
                        <span class="badge {{ $position->status == 'Active' ? 'badge-active' : 'badge-inactive' }}">
                        {{ $position->status }}
                        </span>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <form action="{{ route('position.destroy', $position->position_id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="position-action-link delete-link">Delete</button>
                            </form> 
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center py-4 text-gray-500 dark:text-gray-400">No position found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Add Position Modal --}}
<div id="positionModal" class="modal-backdrop">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Add position</h3>
            <button class="btn-close" onclick="closeModal()">
                <i data-lucide="x"></i>
            </button>
        </div>
        <form class="modal-form" action="{{ route('position.store') }}" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <label>Department <span class="required">*</span></label>
                    <select name="department_id" class="form-select">
                        @foreach($departments as $department)
                            <option value="{{ $department->department_id }}">{{ $department->department_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Position code <span class="required">*</span></label>
                    <input type="text" name ="position_code" class="form-input" 
                            placeholder="e.g. MGR" value="{{old('position_code')}}" required>
                </div>
                <div class="form-group">
                    <label>Position name <span class="required">*</span></label>
                    <input type="text" name="position_name" class="form-input" 
                            placeholder="e.g. Manager" value="{{old('position_name')}}" required>
                </div>
            </div>
            <div class="form-group-full">
                <label>Description</label>
                <input type="text" name="description" class="form-input" 
                        placeholder="Description" value="{{old('description')}}">
            </div>
            <div class="form-group-full half-width">
                <label>Basic Salary <span class="required">*</span></label>
                <input type="number" name="basic_salary" class="form-input"
                        placeholder="e.g. 25000.00" value="{{ old('basic_salary') }}" step="0.01" min="0" required>
            </div>
            <div class="form-group-full half-width">
                <label>Status <span class="required">*</span></label>
                <select class="form-select" name="status">
                    <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Active</option>
                    <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="closeModal()">Cancel</button>
                <button type="submit" class="btn-primary">Save position</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function openModal() {
        document.getElementById('positionModal').classList.add('show');
        if(typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    }

    function closeModal() {
        document.getElementById('positionModal').classList.remove('show');
    }

    window.onclick = function(event) {
        const modal = document.getElementById('positionModal');
        if (event.target == modal) {
            closeModal();
        }
    }

    @if(session('success'))
        new Notyf().success('{{ session('success') }}');
    @endif
    @if(session('error'))
        new Notyf().error('{{ session('error') }}');
    @endif
    
    @if($errors->any())
        document.addEventListener('DOMContentLoaded', () => openModal());
        @foreach($errors->all() as $error)
            // new Notyf().error('{{ $error }}');
        @endforeach
    @endif
</script>
@endsection
