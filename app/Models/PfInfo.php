<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PfInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'pf_applicable',
        'pf_joining_date',
        'pf_no',
        'pf_last_date',
        'pension_joining_date',
        'pension_applicable',
    ];
    
}
