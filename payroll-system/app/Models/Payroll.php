<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $table = 'payroll';
    protected $primaryKey = 'payroll_id';

    protected $fillable = [

        'payroll_period_start',
        'payroll_period_end',
        'payroll_date',

        //employee earned salary with deductions and benefits
        'basic_salary',
        'overtime_pay',
        'gross_pay',
        'total_deductions',
        'net_pay',
        
        'employee_id',
    ];
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }
}
