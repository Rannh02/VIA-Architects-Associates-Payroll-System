<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sss extends Model
{
    protected $table = 'sss';
    protected $primaryKey = 'sss_id';
    public $incrementing = true;

    protected $fillable = [
        'sss_range_from',
        'sss_range_to',
        'monthly_salary_credit',
        'employee_share',
        'employer_share'
        ];

    protected $casts = [
        'sss_range_from' => 'decimal:2',
        'sss_range_to' => 'decimal:2',
        'monthly_salary_credit' => 'decimal:2',
        'employee_share' => 'decimal:2',
        'employer_share' => 'decimal:2'
    ];
}

