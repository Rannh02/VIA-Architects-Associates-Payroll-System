<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $table = 'position';
    protected $primaryKey = 'position_id';

    protected $fillable = [
        'position_name',
        'basic_salary'
    ];
}
