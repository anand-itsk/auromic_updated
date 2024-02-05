<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'policy_no',
        'policy_term',
        'lic_id',
        'annual_renewable_date',
    ];

    
}
