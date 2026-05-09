<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $table = 'payroll';
    protected $primaryKey = 'payroll_id';

    protected $fillable = [
        'employee_id',
        'payroll_period_start',
        'payroll_period_end',
        'payroll_date',

        // Earnings
        'basic_salary',
        'overtime_pay',
        'gross_pay',

        // Government contributions
        'sss',
        'philhealth',
        'hdmf',
        'tax',

        // Summary
        'total_deductions',
        'net_pay',
    ];
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }
}
