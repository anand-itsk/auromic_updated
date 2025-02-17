<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeHistory extends Model
{
    use HasFactory;

       protected $fillable=[
        'employee_id ',
        'joining_date',
        'relieving_date',
        'relieving_reason'
    ];
}
