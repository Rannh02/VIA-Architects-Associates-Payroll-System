@extends('layouts.master')

@section('title', 'Payroll Run - VIA Architects Associates')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/manage-employee.css') }}">
@endsection

@section('content')
    <div class="max-w-full mx-auto px-6">
        <div class="content-header">
            <div>
                <h2 class="header-title">Payroll Run — June 2025</h2>
                <p class="header-subtitle">
                    <span class="subtitle-dot"></span>
                    Employees - All Departments
                </p>
            </div>
        </div>

        <div class="employee-search-container">
            <div class="employee-search-input-wrapper">
                <input type="text" placeholder="Search employees..." class="employee-search-input" />
            </div>
            <div class="employee-department-select">
                <select>
                    <option>All Departments</option>
                    <option>Engineering</option>
                    <option>Finance</option>
                    <option>Human Resources</option>
                    <option>Sales</option>
                    <option>Marketing</option>
                </select>
            </div>
        </div>

        <div class="employee-table-container">
            <table class="employee-table" style="font-size: 0.75rem;">
                <thead>
                    <tr>
                        <th>Employee</th>
                        <th>Basic Earned</th>
                        <th>OT Pay</th>
                        <th>Allowance</th>
                        <th>Bonus</th>
                        <th>Gross</th>
                        <th>SSS</th>
                        <th>Philhealth</th>
                        <th>Pag-IBIG</th>
                        <th>Absence</th>
                        <th>Late</th>
                        <th>Tax</th>
                        <th>Total DED</th>
                        <th>Net Pay</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="employee-id">
                            <div class="employee-name-cell">
                                <span class="employee-avatar">M</span>
                                <div>
                                    <p class="employee-name">Maria Santos</p>
                                </div>
                            </div>
                        </td>
                        <td style="color: #0f172a;">₱55,000.00</td>
                        <td style="color: #0f172a;">₱1,171.875</td>
                        <td style="color: #0f172a;">₱3,000.00</td>
                        <td style="color: #0f172a;">₱5,000.00</td>
                        <td style="color: #0f172a; font-weight: 600;">₱64,171.875</td>
                        <td style="color: #dc2626;">-₱1,350.00</td>
                        <td style="color: #dc2626;">-₱1,375.00</td>
                        <td style="color: #dc2626;">-₱200.00</td>
                        <td style="color: #dc2626;">-₱0.00</td>
                        <td style="color: #dc2626;">-₱671.875</td>
                        <td style="color: #dc2626;">-₱7,457.775</td>
                        <td style="color: #dc2626;">-₱11,054.65</td>
                        <td style="color: #059669; font-weight: 600;">₱53,117.225</td>
                        <td><a href="#" class="employee-action-link">Payslip</a></td>
                    </tr>
                    <tr>
                        <td class="employee-id">
                            <div class="employee-name-cell">
                                <span class="employee-avatar">J</span>
                                <div>
                                    <p class="employee-name">Juan dela Cruz</p>
                                </div>
                            </div>
                        </td>
                        <td style="color: #0f172a;">₱32,618.182</td>
                        <td style="color: #0f172a;">₱2,159.091</td>
                        <td style="color: #0f172a;">₱2,000.00</td>
                        <td style="color: #0f172a;">₱0.00</td>
                        <td style="color: #0f172a; font-weight: 600;">₱36,877.273</td>
                        <td style="color: #dc2626;">-₱1,350.00</td>
                        <td style="color: #dc2626;">-₱2000.00</td>
                        <td style="color: #dc2626;">-₱200.00</td>
                        <td style="color: #dc2626;">-₱5,131.818</td>
                        <td style="color: #dc2626;">-₱464.205</td>
                        <td style="color: #dc2626;">-₱2,133.858</td>
                        <td style="color: #dc2626;">-₱10,249.877</td>
                        <td style="color: #059669; font-weight: 600;">₱26,727.396</td>
                        <td><a href="#" class="employee-action-link">Payslip</a></td>
                    </tr>
                    <tr>
                        <td class="employee-id">
                            <div class="employee-name-cell">
                                <span class="employee-avatar">A</span>
                                <div>
                                    <p class="employee-name">Ana Reyes</p>
                                </div>
                            </div>
                        </td>
                        <td style="color: #0f172a;">₱31,272.727</td>
                        <td style="color: #0f172a;">₱1,136.364</td>
                        <td style="color: #0f172a;">₱1,500.00</td>
                        <td style="color: #0f172a;">₱2,000.00</td>
                        <td style="color: #0f172a; font-weight: 600;">₱35,909.091</td>
                        <td style="color: #dc2626;">-₱1,350.00</td>
                        <td style="color: #dc2626;">-₱1000.00</td>
                        <td style="color: #dc2626;">-₱200.00</td>
                        <td style="color: #dc2626;">-₱0.00</td>
                        <td style="color: #dc2626;">-₱408.455</td>
                        <td style="color: #dc2626;">-₱1,020.218</td>
                        <td style="color: #dc2626;">-₱3,716.673</td>
                        <td style="color: #059669; font-weight: 600;">₱31,103.418</td>
                        <td><a href="#" class="employee-action-link">Payslip</a></td>
                    </tr>
                    <tr>
                        <td class="employee-id">
                            <div class="employee-name-cell">
                                <span class="employee-avatar">C</span>
                                <div>
                                    <p class="employee-name">Carlo Mendoza</p>
                                </div>
                            </div>
                        </td>
                        <td style="color: #0f172a;">₱37,227.273</td>
                        <td style="color: #0f172a;">₱1,193.182</td>
                        <td style="color: #0f172a;">₱4,000.00</td>
                        <td style="color: #0f172a;">₱0.00</td>
                        <td style="color: #0f172a; font-weight: 600;">₱36,428.455</td>
                        <td style="color: #dc2626;">-₱1,350.00</td>
                        <td style="color: #dc2626;">-₱1,050.00</td>
                        <td style="color: #dc2626;">-₱200.00</td>
                        <td style="color: #dc2626;">-₱1,009.091</td>
                        <td style="color: #dc2626;">-₱859.001</td>
                        <td style="color: #dc2626;">-₱4,772.401</td>
                        <td style="color: #dc2626;">-₱10,148.673</td>
                        <td style="color: #059669; font-weight: 600;">₱40,279.782</td>
                        <td><a href="#" class="employee-action-link">Payslip</a></td>
                    </tr>
                    <tr>
                        <td class="employee-id">
                            <div class="employee-name-cell">
                                <span class="employee-avatar">L</span>
                                <div>
                                    <p class="employee-name">Liza Tañada</p>
                                </div>
                            </div>
                        </td>
                        <td style="color: #0f172a;">₱40,618.182</td>
                        <td style="color: #0f172a;">₱2,363.636</td>
                        <td style="color: #0f172a;">₱3,500.00</td>
                        <td style="color: #0f172a;">₱3,000.00</td>
                        <td style="color: #0f172a; font-weight: 600;">₱53,481.818</td>
                        <td style="color: #dc2626;">-₱1,200.00</td>
                        <td style="color: #dc2626;">-₱1,200.00</td>
                        <td style="color: #dc2626;">-₱200.00</td>
                        <td style="color: #dc2626;">-₱2,131.818</td>
                        <td style="color: #dc2626;">-₱727.273</td>
                        <td style="color: #dc2626;">-₱5,304.764</td>
                        <td style="color: #dc2626;">-₱11,053.055</td>
                        <td style="color: #059669; font-weight: 600;">₱42,627.964</td>
                        <td><a href="#" class="employee-action-link">Payslip</a></td>
                    </tr>
                    <tr style="background: #f1f5f9; font-weight: 600;">
                        <td style="color: #0f172a; padding: 1rem 1.5rem; border-right: 1px solid #cbd5e1;">TOTALS</td>
                        <td style="color: #0f172a; padding: 1rem 1.5rem; border-right: 1px solid #cbd5e1;">₱202,136.364</td>
                        <td style="color: #0f172a; padding: 1rem 1.5rem; border-right: 1px solid #cbd5e1;">₱7,824.148</td>
                        <td style="color: #0f172a; padding: 1rem 1.5rem; border-right: 1px solid #cbd5e1;">₱14,000.00</td>
                        <td style="color: #0f172a; padding: 1rem 1.5rem; border-right: 1px solid #cbd5e1;">₱10,000.00</td>
                        <td style="color: #0f172a; padding: 1rem 1.5rem; border-right: 1px solid #cbd5e1;">₱241,160.511</td>
                        <td style="color: #dc2626; padding: 1rem 1.5rem; border-right: 1px solid #cbd5e1;">-₱1,750.00</td>
                        <td style="color: #dc2626; padding: 1rem 1.5rem; border-right: 1px solid #cbd5e1;">-₱5,375.00</td>
                        <td style="color: #dc2626; padding: 1rem 1.5rem; border-right: 1px solid #cbd5e1;">-₱1,000.00</td>
                        <td style="color: #dc2626; padding: 1rem 1.5rem; border-right: 1px solid #cbd5e1;">-₱9,272.727</td>
                        <td style="color: #dc2626; padding: 1rem 1.5rem; border-right: 1px solid #cbd5e1;">-₱3,167.598</td>
                        <td style="color: #dc2626; padding: 1rem 1.5rem; border-right: 1px solid #cbd5e1;">-₱21,649.182</td>
                        <td style="color: #dc2626; padding: 1rem 1.5rem; border-right: 1px solid #cbd5e1;">-₱47,214.727</td>
                        <td style="color: #059669; padding: 1rem 1.5rem; border-right: 1px solid #cbd5e1;">₱193,945.784</td>
                        <td style="padding: 1rem 1.5rem;"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
