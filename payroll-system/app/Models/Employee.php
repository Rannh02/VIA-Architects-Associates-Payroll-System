<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employee';
    protected $primaryKey = 'employee_id';

    protected $fillable = [
        'position_id',
        'department_id',
        'created_by',
        
        // Personal Information
        'first_name',
        'middle_name',
        'last_name',
        'sex',

        // Current Address
        'current_street_address',
        'current_barangay',
        'current_city_municipality',
        'current_province',
        'current_zip_code',

        // Permanent Address
        'permanent_street_address',
        'permanent_barangay',
        'permanent_city_municipality',
        'permanent_province',
        'permanent_zip_code',

        // Other Details
        'contact_info',
        'date_of_birth',
        'salary_rate',
        'hire_date',
        'employment_status',
        'marital_status',
        'number_of_dependents',
        'spouse',
    ];

    // Relationships
    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id', 'position_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'department_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
