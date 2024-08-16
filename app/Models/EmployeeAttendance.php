<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeAttendance extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function employeeName()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
