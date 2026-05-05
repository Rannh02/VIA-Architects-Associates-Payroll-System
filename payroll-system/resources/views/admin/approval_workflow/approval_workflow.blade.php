@extends('layouts.master')

@section('title', 'Approval WorkFlow- VIA Architects Assosciates')
@section('content')
    <div class="max-w-[1600px] mx-auto">
        <div class="content-header">
            <div>
                <h2 class="header-title">Approval WorkFlow </h2>
                <p class="header-subtitle">
                    <span class="subtitle-dot"></span>
                    Manage Approval WorkFlow
                </p>
            </div>
            <div class="header-actions">
                <button class="btn-secondary">
                    <i data-lucide="filter" class="h-4 w-4 text-blue-500"></i>
                    Filter
                </button>
                <button class="btn-primary">
                    <i data-lucide="plus" class="h-4 w-4"></i>
                    New Request
                </button>
            </div>
        </div>

        <!-- Leave Requests Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Employee</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Start Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">End Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <!-- Example Row -->
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap flex items-center">
                            <img src="/images/avatar-placeholder.png" alt="Avatar" class="h-8 w-8 rounded-full mr-3">
                            John Doe
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">Vacation</td>
                        <td class="px-6 py-4 whitespace-nowrap">2024-07-01</td>
                        <td class="px-6 py-4 whitespace-nowrap">2024-07-10</td>
                        <td class="px-6 py-4 whitespace-nowrap">    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">Pending</span></td>
                        <td class="px-6 py-4 whitespace-nowrap">
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection